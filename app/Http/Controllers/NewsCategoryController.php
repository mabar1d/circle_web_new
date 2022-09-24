<?php

namespace App\Http\Controllers;

use App\Helpers\ApiCircleHelpers;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller
{
    public function index()
    {
        return view('newsCategory/index');
    }

    public function getListDatatable(Request $request)
    {
        $requestData = $request->input();
        $search = isset($requestData["search"]["value"]) && $requestData["search"]["value"] ? $requestData["search"]["value"] : NULL;
        $user = session()->get('user');
        $url = env('API_CIRCLE') . 'getListNewsCategory';
        $requestBody['user_id'] = $user->id;
        $requestBody['search'] = $search;
        $requestBody['page'] = 1;

        $response = ApiCircleHelpers::sendApi($url, "POST", $requestBody);
        $listDatatable["data"] = array();
        if ($response["code"] == "00") {
            $no = 1;
            foreach ($response["data"] as $rowData) {
                $status = "Active";
                if ($rowData["status"] != 1) {
                    $status = "Not Active";
                }
                $listDatatable["recordsTotal"] = 57;
                $listDatatable["recordsFiltered"] = 57;
                $listDatatable["data"][] = array(
                    "no" => $no++,
                    "name" => $rowData["name"],
                    "desc" => $rowData["desc"],
                    "status" => $status,
                    "action" => "action"
                );
            }
        }
        return json_encode($listDatatable);
    }

    public function getTable(Request $request)
    {
        $requestData = $request->input();
        $search = isset($requestData["search"]) && $requestData["search"] ? $requestData["search"] : NULL;
        $page = isset($requestData["page"]) && $requestData["page"] ? $requestData["page"] : 1;
        $user = session()->get('user');
        $url = env('API_CIRCLE') . 'getListNewsCategory';
        $requestBody['user_id'] = $user->id;
        $requestBody['search'] = $search;
        $requestBody['page'] = $page;

        $response = ApiCircleHelpers::sendApi($url, "POST", $requestBody);
        $listData = array();
        if ($response["code"] == "00") {
            foreach ($response["data"] as $rowData) {
                $status = "Active";
                if ($rowData["status"] != 1) {
                    $status = "Not Active";
                }
                $listData[] = array(
                    "name" => $rowData["name"],
                    "desc" => $rowData["desc"],
                    "status" => $status,
                    "action" => "action"
                );
            }
            $response["html"] = view('newsCategory.table', [
                "listData" => $listData
            ])->render();
            if (count($response["data"]) > 0) {
                $response["nextPage"] = $page + 1;
                $response["prevPage"] = $page - 1;
            } else {
                $response["nextPage"] = $page;
                $response["prevPage"] = $page - 1;
            }
        }
        return json_encode($response);
    }

    public function store()
    {
        return view('news/addNews');
    }
}
