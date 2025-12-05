<?php declare(strict_types = 1);

// odsl-/Users/junlonglin/Herd/CrediBiz/app
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v1',
   'data' => 
  array (
    '/Users/junlonglin/Herd/CrediBiz/app/Providers/AppServiceProvider.php' => 
    array (
      0 => 'b05d06e9cb0c835b310d233e03a8ba9e97dd14d7',
      1 => 
      array (
        0 => 'app\\providers\\appserviceprovider',
      ),
      2 => 
      array (
        0 => 'app\\providers\\register',
        1 => 'app\\providers\\boot',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Models/IssuedVC.php' => 
    array (
      0 => '3ea5ef3b03d84f84252357b52c75775a4fe15956',
      1 => 
      array (
        0 => 'app\\models\\issuedvc',
      ),
      2 => 
      array (
        0 => 'app\\models\\employee',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Models/User.php' => 
    array (
      0 => '0de556dcaed737c421ea5b9b029f7cc1445768cf',
      1 => 
      array (
        0 => 'app\\models\\user',
      ),
      2 => 
      array (
        0 => 'app\\models\\casts',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Models/ParkingPermit.php' => 
    array (
      0 => '98f049d321c8701d2e7b43550ae1ae5059744ac8',
      1 => 
      array (
        0 => 'app\\models\\parkingpermit',
      ),
      2 => 
      array (
        0 => 'app\\models\\generatepermitid',
        1 => 'app\\models\\employee',
        2 => 'app\\models\\vehicles',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Models/MedicalLeave.php' => 
    array (
      0 => 'c4589e0eb074b838e0fee6d1c115fda97bd2f4df',
      1 => 
      array (
        0 => 'app\\models\\medicalleave',
      ),
      2 => 
      array (
        0 => 'app\\models\\employee',
        1 => 'app\\models\\vpverification',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Models/ParkingPermitVehicle.php' => 
    array (
      0 => '0afd36e9be4318917d3d60ad25df2e59cfc691c6',
      1 => 
      array (
        0 => 'app\\models\\parkingpermitvehicle',
      ),
      2 => 
      array (
        0 => 'app\\models\\parkingpermit',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Models/EmployeeLoginLog.php' => 
    array (
      0 => '2fe0e4547e756c3076f5240d4d82b06066f2a421',
      1 => 
      array (
        0 => 'app\\models\\employeeloginlog',
      ),
      2 => 
      array (
        0 => 'app\\models\\employee',
        1 => 'app\\models\\vpverificationresult',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Models/VPVerificationResult.php' => 
    array (
      0 => '08eeaa7bb616cc93fd3f5018cda386870ce007f7',
      1 => 
      array (
        0 => 'app\\models\\vpverificationresult',
      ),
      2 => 
      array (
        0 => 'app\\models\\employee',
        1 => 'app\\models\\medicalleaves',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Models/Employee.php' => 
    array (
      0 => 'f29dfc529fe2bb263665df3891368c782400c4ea',
      1 => 
      array (
        0 => 'app\\models\\employee',
      ),
      2 => 
      array (
        0 => 'app\\models\\generateemployeeid',
        1 => 'app\\models\\generatecredentialtoken',
        2 => 'app\\models\\issuedvcs',
        3 => 'app\\models\\medicalleaves',
        4 => 'app\\models\\activitylogs',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Models/ActivityLog.php' => 
    array (
      0 => 'd609aea2988f434c954f89c25aaf22cd6725018f',
      1 => 
      array (
        0 => 'app\\models\\activitylog',
      ),
      2 => 
      array (
        0 => 'app\\models\\employee',
        1 => 'app\\models\\actor',
        2 => 'app\\models\\log',
        3 => 'app\\models\\logvcissue',
        4 => 'app\\models\\logvpverification',
        5 => 'app\\models\\logvcrevoke',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Models/VisitorParkingApplication.php' => 
    array (
      0 => '93fe12ec8b52ce28b1bb325229680e7fb8ec27ed',
      1 => 
      array (
        0 => 'app\\models\\visitorparkingapplication',
      ),
      2 => 
      array (
        0 => 'app\\models\\generatevisitortoken',
        1 => 'app\\models\\generatepermitid',
        2 => 'app\\models\\reviewer',
        3 => 'app\\models\\getstatustextattribute',
        4 => 'app\\models\\getclaimurlattribute',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Models/VPVerificationLog.php' => 
    array (
      0 => '3a1ef7755a651a8525e6b1115d7a43236d01c898',
      1 => 
      array (
        0 => 'app\\models\\vpverificationlog',
      ),
      2 => 
      array (
        0 => 'app\\models\\logconfigrequest',
        1 => 'app\\models\\logscandetected',
        2 => 'app\\models\\logverifysuccess',
        3 => 'app\\models\\logverifyfailed',
        4 => 'app\\models\\machine',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Models/ApiLog.php' => 
    array (
      0 => '45a1cbc427b2993d4067c442d35ea28e0210c2d7',
      1 => 
      array (
        0 => 'app\\models\\apilog',
      ),
      2 => 
      array (
        0 => 'app\\models\\logapicall',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Models/VPMachine.php' => 
    array (
      0 => '0d9ce432e919df52aa36ab20d0c95e896d68eb92',
      1 => 
      array (
        0 => 'app\\models\\vpmachine',
      ),
      2 => 
      array (
        0 => 'app\\models\\getconfigbymachineid',
        1 => 'app\\models\\isactive',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Models/VCStatusChangeLog.php' => 
    array (
      0 => '10bdcae1c5b6ff8b99814942bfe25dc4c73c56d0',
      1 => 
      array (
        0 => 'app\\models\\vcstatuschangelog',
      ),
      2 => 
      array (
        0 => 'app\\models\\employee',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Controller.php' => 
    array (
      0 => 'a33a5105f92c73a309c9f8a549905dcdf6dccbae',
      1 => 
      array (
        0 => 'app\\http\\controllers\\controller',
      ),
      2 => 
      array (
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/AuthController.php' => 
    array (
      0 => '980ef833c1428798655152deaca3524a8eac7183',
      1 => 
      array (
        0 => 'app\\http\\controllers\\authcontroller',
      ),
      2 => 
      array (
        0 => 'app\\http\\controllers\\login',
        1 => 'app\\http\\controllers\\logout',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminVisitorParkingController.php' => 
    array (
      0 => '499cb4b048241dad450ad05dde2f8ccb443d8f9a',
      1 => 
      array (
        0 => 'app\\http\\controllers\\admin\\adminvisitorparkingcontroller',
      ),
      2 => 
      array (
        0 => 'app\\http\\controllers\\admin\\store',
        1 => 'app\\http\\controllers\\admin\\index',
        2 => 'app\\http\\controllers\\admin\\show',
        3 => 'app\\http\\controllers\\admin\\approve',
        4 => 'app\\http\\controllers\\admin\\reject',
        5 => 'app\\http\\controllers\\admin\\statistics',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminApiLogController.php' => 
    array (
      0 => 'd93d2bf2af9cdbaa5020600fe0e14a3190b8c9ae',
      1 => 
      array (
        0 => 'app\\http\\controllers\\admin\\adminapilogcontroller',
      ),
      2 => 
      array (
        0 => 'app\\http\\controllers\\admin\\index',
        1 => 'app\\http\\controllers\\admin\\show',
        2 => 'app\\http\\controllers\\admin\\statistics',
        3 => 'app\\http\\controllers\\admin\\cleanup',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminDashboardController.php' => 
    array (
      0 => '0be8687a58b829772c6ddade4d6dfe91fe0929b0',
      1 => 
      array (
        0 => 'app\\http\\controllers\\admin\\admindashboardcontroller',
      ),
      2 => 
      array (
        0 => 'app\\http\\controllers\\admin\\index',
        1 => 'app\\http\\controllers\\admin\\getloginlogs',
        2 => 'app\\http\\controllers\\admin\\getvcissuedlogs',
        3 => 'app\\http\\controllers\\admin\\getvpverificationlogs',
        4 => 'app\\http\\controllers\\admin\\getvcstatuschangelogs',
        5 => 'app\\http\\controllers\\admin\\getemployees',
        6 => 'app\\http\\controllers\\admin\\revokecredential',
        7 => 'app\\http\\controllers\\admin\\reissuecredential',
        8 => 'app\\http\\controllers\\admin\\getmedicalleaves',
        9 => 'app\\http\\controllers\\admin\\getmedicalleavevplogs',
        10 => 'app\\http\\controllers\\admin\\getactivitylogs',
        11 => 'app\\http\\controllers\\admin\\getactivitystats',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminEmployeeController.php' => 
    array (
      0 => '9d7606f05ee5cd33dc3523d75bcd9d22639d76d0',
      1 => 
      array (
        0 => 'app\\http\\controllers\\admin\\adminemployeecontroller',
      ),
      2 => 
      array (
        0 => 'app\\http\\controllers\\admin\\index',
        1 => 'app\\http\\controllers\\admin\\show',
        2 => 'app\\http\\controllers\\admin\\revokevc',
        3 => 'app\\http\\controllers\\admin\\reissuevc',
        4 => 'app\\http\\controllers\\admin\\resign',
        5 => 'app\\http\\controllers\\admin\\update',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/Admin/AdminMedicalLeaveController.php' => 
    array (
      0 => 'd0f3a61022fedf23abd03fd768e42f4dbaf2beca',
      1 => 
      array (
        0 => 'app\\http\\controllers\\admin\\adminmedicalleavecontroller',
      ),
      2 => 
      array (
        0 => 'app\\http\\controllers\\admin\\index',
        1 => 'app\\http\\controllers\\admin\\show',
        2 => 'app\\http\\controllers\\admin\\approve',
        3 => 'app\\http\\controllers\\admin\\reject',
        4 => 'app\\http\\controllers\\admin\\statistics',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/VisitorParkingController.php' => 
    array (
      0 => 'a610417e2fee923bae1bca516c1a9dcfe6dc22bf',
      1 => 
      array (
        0 => 'app\\http\\controllers\\visitorparkingcontroller',
      ),
      2 => 
      array (
        0 => 'app\\http\\controllers\\store',
        1 => 'app\\http\\controllers\\show',
        2 => 'app\\http\\controllers\\claim',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ParkingPermitController.php' => 
    array (
      0 => 'beace67f04cc44b31b2c2925bf054d05be1930d6',
      1 => 
      array (
        0 => 'app\\http\\controllers\\parkingpermitcontroller',
      ),
      2 => 
      array (
        0 => 'app\\http\\controllers\\generateverificationqr',
        1 => 'app\\http\\controllers\\verifyemployeecredential',
        2 => 'app\\http\\controllers\\apply',
        3 => 'app\\http\\controllers\\confirmissuance',
        4 => 'app\\http\\controllers\\show',
        5 => 'app\\http\\controllers\\updatevehicles',
        6 => 'app\\http\\controllers\\reissue',
        7 => 'app\\http\\controllers\\parseclaimstoarray',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/MedicalLeaveController.php' => 
    array (
      0 => '82be293e12a067d11b029acd82965e589d07914d',
      1 => 
      array (
        0 => 'app\\http\\controllers\\medicalleavecontroller',
      ),
      2 => 
      array (
        0 => 'app\\http\\controllers\\verifymedicalcertificate',
        1 => 'app\\http\\controllers\\store',
        2 => 'app\\http\\controllers\\index',
        3 => 'app\\http\\controllers\\parseclaimstoarray',
        4 => 'app\\http\\controllers\\savevpverificationlog',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/ApplicationController.php' => 
    array (
      0 => 'd6c79dc7ef75b1d594a0bff1fba532b838f788af',
      1 => 
      array (
        0 => 'app\\http\\controllers\\applicationcontroller',
      ),
      2 => 
      array (
        0 => 'app\\http\\controllers\\store',
        1 => 'app\\http\\controllers\\extractvcdata',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/EmployeeCredentialController.php' => 
    array (
      0 => '80dc3cde2ee8d38661c285c1147309115b741d4f',
      1 => 
      array (
        0 => 'app\\http\\controllers\\employeecredentialcontroller',
      ),
      2 => 
      array (
        0 => 'app\\http\\controllers\\show',
        1 => 'app\\http\\controllers\\issue',
        2 => 'app\\http\\controllers\\updatecredential',
        3 => 'app\\http\\controllers\\reissue',
        4 => 'app\\http\\controllers\\confirmreissue',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Http/Controllers/VPMachineController.php' => 
    array (
      0 => 'fad582d5b5996d5cc41e0ff0df3ce0f5b78e6ad8',
      1 => 
      array (
        0 => 'app\\http\\controllers\\vpmachinecontroller',
      ),
      2 => 
      array (
        0 => 'app\\http\\controllers\\getconfig',
        1 => 'app\\http\\controllers\\verifyresult',
        2 => 'app\\http\\controllers\\extractparkingpermitdata',
        3 => 'app\\http\\controllers\\validateparkingpermit',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Rules/RocIdNumber.php' => 
    array (
      0 => '7448bfd80b7a202cc24d823494096781cd23f5bc',
      1 => 
      array (
        0 => 'app\\rules\\rocidnumber',
      ),
      2 => 
      array (
        0 => 'app\\rules\\validate',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Services/TWDIWIssuerService.php' => 
    array (
      0 => '843771c6da107b4fdf1b17513156935879857a45',
      1 => 
      array (
        0 => 'app\\services\\twdiwissuerservice',
      ),
      2 => 
      array (
        0 => 'app\\services\\__construct',
        1 => 'app\\services\\issuevc',
        2 => 'app\\services\\getvcstatus',
        3 => 'app\\services\\changevcstatus',
        4 => 'app\\services\\sanitizeheaders',
      ),
      3 => 
      array (
      ),
    ),
    '/Users/junlonglin/Herd/CrediBiz/app/Services/TWDIWVerifierService.php' => 
    array (
      0 => '3811ac0507e605d39cf4fd991b85f41305e20591',
      1 => 
      array (
        0 => 'app\\services\\twdiwverifierservice',
      ),
      2 => 
      array (
        0 => 'app\\services\\__construct',
        1 => 'app\\services\\generatevpqrcode',
        2 => 'app\\services\\getvpresult',
        3 => 'app\\services\\sanitizeheaders',
        4 => 'app\\services\\getstoredvpresult',
        5 => 'app\\services\\markvpresultasused',
      ),
      3 => 
      array (
      ),
    ),
  ),
));