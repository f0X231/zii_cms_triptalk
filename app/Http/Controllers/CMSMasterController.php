<?php

namespace App\Http\Controllers;

use \Datetime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Crypt;

use App\Models\UserGroups   as UserGroups;

class CMSMasterController extends Controller
{
    private $itemPerPages = 12;

    // public function __construct(Request $request) 
    // {
    //     $this->sessionUser = Session()->get('user');
    //     if(empty($this->sessionUser) || ($this->sessionUser['lavel'] <= 1)) {
    //         $request->session()->forget('user');
    //         redirect('login')->send();
    //     }
    // }

    // public function index(Request $request)
    // {
    // }

    public function indexCompany(Request $request)
    {
        $pageInfo = array(
            'name'          => 'masterCompany',
            'title'         => '',
            'description'   => '',
            'keywords'      => '',
            'picture'       => ''
        );
        $page = empty($_GET['page']) ? 1 : (is_numeric($_GET['page']) ? $_GET['page'] : 1);
        $offset = (($page - 1) < 0) ? 0 : (($page - 1) * $this->itemPerPages);
        $countCompanys = UserGroups::where([['flag_deleted', '=', 'N']])->count();
        $pages = ceil($countCompanys/$this->itemPerPages);

        if(!empty($_GET['page']) && !is_numeric($_GET['page']))
            redirect('/cms/master/company')->send();            

        if($page < 1)
            redirect('/cms/master/company?page=1')->send();

        if($page > $pages)
            redirect('/cms/master/company?page='.$pages)->send();

        $getCompanys = UserGroups::where([['flag_deleted', '=', 'N']])
                                ->orderBy('updated_at', 'DESC')
                                ->orderBy('created_at', 'DESC')
                                ->orderBy('id', 'DESC')
                                ->skip($offset)
                                ->take($this->itemPerPages)
                                ->get()
                                ->toArray();

        return view(    'backend.pages.masterCompany', 
                        [ 
                            'pinfo'     => $pageInfo,
                            'company'   => $getCompanys,
                            'pages'     => $pages,
                            'page'      => $page,
                            'amount'    => $this->itemPerPages,
                        ]); 
    }

    public function modifyCompany(Request $request)
    {
        $pageInfo = array(
            'name'          => 'masterCompany',
            'title'         => '',
            'description'   => '',
            'keywords'      => '',
            'picture'       => ''
        );

        $getCompany = [];
        if(!empty($request->id)) {
            $tmpCompany = UserGroups::where([['id', '=', $request->id]])->get()->toArray();
            $getCompany = empty($tmpCompany[0]) ? [] : $tmpCompany[0];
            $getCompany['encryptId'] =  Crypt::encryptString($request->id);
            //$getCompany['decryptId'] =  Crypt::decryptString($getCompany['encryptId']);
        }

        return view(    'backend.pages.masterCompanyModify',
                        [
                            'pinfo'     => $pageInfo,
                            'company'   => $getCompany,
                        ]);
    }

    public function processCompany(Request $request)
    {
        $request->validate([
                            'inCompanyName'     => 'required',
                            'inCompanyPhone'    => 'required',
                            'inCompanyMail'     => 'required',
                        ]);
        
        $processName    = $request->name;
        $param          = $request->post();
        $now            = new DateTime();
        $acceptExt      = array('jpg', 'jpeg', 'png');
        $companyLogo    = NULL;
        // upload logo company image
        if($request->hasFile('inCompanyLogo')) 
        {
            // $fileExt = $request->inCompanyLogo->extension();
            // if ($request->file('inCompanyLogo')->isValid() && in_array($fileExt, $acceptExt)) {
            //     $newFileName = md5($now->format('Y-m-d H:i:s')) . '.' . $request->inCompanyLogo->extension();
            //     $request->inCompanyLogo->move(base_path(config('global.path_base').'company'), $newFileName);
            //     $companyLogo = $newFileName;
            // }
            $savePath = base_path(config('global.path_base').'company');
            $responseSaveImg = $this->uploadImg($request->inCompanyLogo, $savePath, $acceptExt);
            if($responseSaveImg->status == 'success')
                $companyLogo = $responseSaveImg->items[0];
        }

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

}