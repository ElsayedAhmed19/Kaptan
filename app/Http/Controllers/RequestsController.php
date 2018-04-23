<?php

namespace App\Http\Controllers;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use App\Helpers\FirebaseHelper;
use Illuminate\Http\Request;
use App\Repositories\RequestsRepository;
use Datatables;
use App\Libraries\RequestsLibrary;

class RequestsController extends Controller
{
    protected $requestsLibrary;
    public function __construct()
    {
        $this->requestsLibrary = new RequestsLibrary;
    }
    public function allRequests()
    {
        return view('requests.all_requests');
    }

    public function datatable(Request $request)
    {
        $currentPath = $request->get('currentPath');
        $datatableData = $this->requestsLibrary->getRequestsInDatatable($currentPath);

        return $datatableData;
    }
}
