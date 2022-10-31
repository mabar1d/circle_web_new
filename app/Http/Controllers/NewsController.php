<?php

namespace App\Http\Controllers;

use App\Helpers\ApiCircleHelpers;
use Illuminate\Http\Request;
use stdClass;

class NewsController extends Controller
{
    public function index()
    {
        return view('news/listNews');
    }

    public function newsList(Request $request)
    {
        $requestData = $request->input();
        $search = isset($requestData["search"]) && $requestData["search"] ? $requestData["search"] : NULL;
        $page = isset($requestData["page"]) && $requestData["page"] ? $requestData["page"] : 1;
        $url = env('API_CIRCLE') . 'getListNews';
        $user = session()->get('user');
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
                    "title" => $rowData["title"],
                    "news_category" => $rowData["news_category_name"],
                    "status" => $status,
                    "id_news" => $rowData["id"],
                    "slug" => $rowData['slug']
                );
            }
            $response["html"] = view('news.table', [
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

    public function addNews()
    {
        $url = env('API_CIRCLE') . 'getListNewsCategory';
        $user = session()->get('user');
        $requestBody['user_id'] = $user->id;
        $requestBody['page'] = 1;


        $response = ApiCircleHelpers::sendApi($url, "POST", $requestBody);
        $listData = new stdClass;

        if ($response['code'] != "00") {
            return view('news.addNews')->with('error', $response['desc']);
        }

        return view('news/addNews', ["list_category" => $response['data']]);
    }

    public function detailNews(Request $request)
    {
        $id_news = $request->id_news;
        $url = env('API_CIRCLE') . 'getInfoNews';
        $user = session()->get('user');
        // $requestBody['user_id'] = $user->id;
        $requestBody['slug'] = $request->slug;

        $response = ApiCircleHelpers::sendApi($url, "POST", $requestBody);
        $listData = new stdClass;

        if ($response['code'] != "00") {
            return redirect()->back()->with('error', $response['desc']);
        }

        if ($response["code"] == "00") {
            $responseData = $response['data'];
            $listData->title = $responseData['title'];
            $listData->content =  $responseData['content'];
            $listData->image =  $responseData['image'];
            $listData->linkShare =  $responseData['linkShare'];
        }

        return view('news.detailNews', ["data" => $listData]);
    }

    public function addNewsNew(Request $request)
    {
        $requestData = $request->input();
        $image = $request->file('file');
        $url = env('API_CIRCLE') . 'createNews';
        $user = session()->get('user');
        $requestBody['user_id'] = $user->id;
        $requestBody['news_category_id'] = $request->news_category;
        $requestBody['title'] = $request->title;
        $requestBody['content'] = $request->content;
        $requestBody['image'] = $image;
        $requestBody['status'] = 1;

        $response = ApiCircleHelpers::sendApi($url, "POST", $requestBody);

        if ($response['code'] != "00") {
            return redirect('addNews')->with('error', $response['desc']);
        }

        return redirect('news/listNews')->with('success', $response['desc']);
    }
}
