<?php

namespace App\Http\Controllers;

use \Datetime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;

use App\Models\Users    as Users;
use App\Models\Roles    as Roles;

class CMSUserController extends Controller
{
    private $itemPerPages;

    public function __construct(Request $request) 
    {
        $this->itemPerPages = $this->setItemPerPages();
    }

    public function indexUserRole(Request $request)
    {
        $pageInfo = array(
            'name'          => 'masterUsers',
            'title'         => '',
            'description'   => '',
            'keywords'      => '',
            'picture'       => ''
        );

        $page = empty($_GET['page']) ? 1 : (is_numeric($_GET['page']) ? $_GET['page'] : 1);
        $offset = (($page - 1) < 0) ? 0 : (($page - 1) * $this->itemPerPages);
        $countRoles = Roles::count();
        $pages = ceil($countRoles/$this->itemPerPages);

        if(!empty($_GET['page']) && !is_numeric($_GET['page']))
           redirect('/cms/master/roles')->send();            

        if(!empty($_GET['page']) && $page < 1)
            redirect('/cms/master/roles?page=1')->send();

        if(!empty($_GET['page']) &&  $page > $pages)
            redirect('/cms/master/roles?page='.$pages)->send();

        $getRoles = Roles::where([['flag_deleted', '=', 'N']])
                            ->orderBy('updated_at', 'DESC')
                            ->orderBy('created_at', 'DESC')
                            ->orderBy('id', 'DESC')
                            ->skip($offset)
                            ->take($this->itemPerPages)
                            ->get()
                            ->toArray();

        return view(    'backend.pages.usersRoles', 
                        [ 
                            'pinfo'     => $pageInfo,
                            'roles'     => $getRoles,
                            'pages'     => $pages,
                            'page'      => $page,
                            'amount'    => $this->itemPerPages,
                        ]); 
    }

    public function modifyUserRole(Request $request)
    {
        $pageInfo = array(
            'name'          => 'masterCompany',
            'title'         => '',
            'description'   => '',
            'keywords'      => '',
            'picture'       => ''
        );

        $getRole = [];
        if(!empty($request->id)) {
            $getRole = UserGroups::where([['id', '=', $request->id]])->get()->toArray();
            $getRole = empty($tmpCompany[0]) ? [] : $tmpCompany[0];
            $getRole['encryptId'] =  Crypt::encryptString($request->id);
            //$getCompany['decryptId'] =  Crypt::decryptString($getCompany['encryptId']);
        }

        return view(    'backend.pages.usersRolesModify',
                        [
                            'pinfo'     => $pageInfo,
                            'role'      => $getRole,
                        ]);
    }

    public function processUserRole(Request $request)
    {
        $request->validate([
            'inCompanyName'     => 'required',
            'inCompanyPhone'    => 'required',
            'inCompanyMail'     => 'required',
        ]);

        $processName    = $request->name;
        $param          = $request->post();
        $now            = new DateTime();

        switch($processName) {
        case 'add':
        $saveUGroups                = new UserGroups;        
        $saveUGroups->slug          = empty($param['inCompanyURI']) ? NULL : $param['inCompanyURI'];
        $saveUGroups->name          = empty($param['inCompanyName']) ? NULL : $param['inCompanyName'];
        $saveUGroups->phone         = empty($param['inCompanyPhone']) ? NULL : $param['inCompanyPhone'];
        $saveUGroups->email         = empty($param['inCompanyMail']) ? NULL : $param['inCompanyMail'];
        $saveUGroups->description   = empty($param['inCompanyInfo']) ? NULL : $param['inCompanyInfo'];
        $saveUGroups->flag_enabled  = (!empty($param['inCompanyStatus']) && $param['inCompanyStatus'] == 'Y') ? 'Y' : 'N';
        $saveUGroups->flag_deleted  = (!empty($param['inCompanyDel']) && $param['inCompanyDel'] == 'Y') ? 'Y' : 'N';
        $saveUGroups->updated_at    = $now->format('Y-m-d H:i:s');
        $saveUGroups->icon          = empty($companyLogo) ? NULL : $companyLogo;

        $saveUGroups->save();
        break;
        case 'edit':
        $updateUGroups = array(
            'slug'          => empty($param['inCompanyURI']) ? NULL : $param['inCompanyURI'],
            'name'          => empty($param['inCompanyName']) ? NULL : $param['inCompanyName'],
            'phone'         => empty($param['inCompanyPhone']) ? NULL : $param['inCompanyPhone'],
            'email'         => empty($param['inCompanyMail']) ? NULL : $param['inCompanyMail'],
            'description'   => empty($param['inCompanyInfo']) ? NULL : $param['inCompanyInfo'],
            'flag_enabled'  => (!empty($param['inCompanyStatus']) && $param['inCompanyStatus'] == 'Y') ? 'Y' : 'N',
            'flag_deleted'  => (!empty($param['inCompanyDel']) && $param['inCompanyDel'] == 'Y') ? 'Y' : 'N',
            'updated_at'    =>  $now->format('Y-m-d H:i:s')
        );

        if(!empty($companyLogo)) {
            $updateUGroups['icon'] = $companyLogo;
            print_r($companyLogo); exit;
        }

        UserGroups::where([['id', '=', is_numeric($param['inCompanyId'])]])->update($updateUGroups);
        break;
        }

        return Redirect::to('/cms/master/company');
        exit;
    }


    public function indexUsers(Request $request)
    {
    }

    public function modifyUser(Request $request)
    {
    }

    public function processUser(Request $request)
    {
    }

}