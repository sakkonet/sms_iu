<?php
if (empty($this->session->userdata('id'))) {
  redirect('login');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <title><?php echo $this->template->title->default("SMS-UCCFS"); ?></title>
  <meta property="og:description" content="<?php echo $this->template->description; ?> ">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php echo $this->template->meta; ?>
  <!-- FontAwesome JS-->
  <script defer src="<?php echo base_url("assets/plugins/fontawesome/js/all.min.js"); ?>"></script>
  <link id="theme-style" rel="stylesheet" href="<?php echo base_url("assets/css/portal.css"); ?>">
  <!-- <link id="theme-style" rel="stylesheet" href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>"> -->
  <!-- Toastr style -->
  <link href="<?php echo base_url("assets/css/plugins/toastr/toastr.min.css"); ?>" rel="stylesheet">
  <!-- Sweet Alert -->
  <link href="<?php echo base_url("assets/css/plugins/sweetalert/sweetalert.css"); ?>" rel="stylesheet">
  <!-- Datatables style -->
  <link href="<?php echo base_url("assets/css/plugins/dataTables/dataTables.bootstrap5.min.css"); ?>" rel="stylesheet">
  <!-- Datepicker style -->
  <link href="<?php echo base_url("assets/css/plugins/datepicker/datepicker3.css"); ?>" rel="stylesheet">
  <script src="<?php echo base_url("assets/js/jquery-3.6.0.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/js/jquery.validate.js"); ?>"></script>
  <?php echo $this->template->stylesheet; ?>

  <style>
    .overlay {
      display: none;
      position: fixed;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      z-index: 3000;
      background: rgba(255, 255, 255, 0.3) url('<?php echo base_url(); ?>images/loader.gif') center no-repeat;
    }

    /* Turn off scrollbar when body element has the loading class */
    body.loading {
      overflow: hidden;
    }

    /* Make spinner image visible when body element has the loading class */
    body.loading .overlay {
      display: block;
    }
  </style>
</head>

<body class="app">
  <header class="app-header fixed-top">
    <div class="app-header-inner">
      <div class="container-fluid py-2">
        <div class="app-header-content">
          <div class="row justify-content-between align-items-center">

            <div class="col-auto">
              <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" role="img">
                  <title>Menu</title>
                  <path stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" d="M4 7h22M4 15h22M4 23h22"></path>
                </svg>
              </a>
            </div>
            <div class="col-auto">
              Total Balance: <span data-bind="visible:parseFloat(balance())<parseFloat(sms_cost())" class="badge bg-danger">UGX:&nbsp;<span data-bind="text:curr_format(balance())"></span></span>
              <span data-bind="visible:parseFloat(balance())>parseFloat(sms_cost())" class="badge bg-success">UGX:&nbsp;<span data-bind="text:curr_format(balance())"></span></span>
            </div>

            <div class="app-utilities col-auto">
              <div class="app-utility-item app-notifications-dropdown dropdown">
                <a class="dropdown-toggle no-toggle-arrow" id="notifications-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" title="Notifications">
                  <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bell icon svg-icon-primary" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z" />
                    <path fill-rule="evenodd" d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                  </svg>
                  <span class="icon-badge">3</span>
                </a>
                <!--//dropdown-toggle-->

                <div class="dropdown-menu p-0" aria-labelledby="notifications-dropdown-toggle">
                  <div class="dropdown-menu-header p-3">
                    <h5 class="dropdown-menu-title mb-0">Notifications</h5>
                  </div>
                  <!--//dropdown-menu-title-->
                  <div class="dropdown-menu-content">
                    <div class="item p-3">
                      <div class="row gx-2 justify-content-between align-items-center">
                        <div class="col-auto">
                          <img class="profile-image" src="<?php echo base_url(); ?>/images/avatar.png" alt="">
                        </div>
                        <!--//col-->
                        <div class="col">
                          <div class="info">
                            <div class="desc">The SMS Messages are Live. </div>
                            <div class="meta"> 2 hrs ago</div>
                          </div>
                        </div>
                        <!--//col-->
                      </div>
                      <!--//row-->
                      <a class="link-mask" href="#"></a>
                    </div>

                  </div>
                  <!--//dropdown-menu-content-->

                  <div class="dropdown-menu-footer p-2 text-center">
                    <a href="#">View all</a>
                  </div>

                </div>
                <!--//dropdown-menu-->
              </div>
              <!--//app-utility-item-->
              <div class="app-utility-item">
                <a href="<?php echo base_url('home/apiKey'); ?>" title="Settings">
                  <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-gear icon svg-icon-primary" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z" />
                    <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z" />
                  </svg>
                </a>
              </div>
              <!--//app-utility-item-->

              <div class="app-utility-item app-user-dropdown dropdown">
                <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><img src="<?php echo base_url(); ?>images/avatar.png" alt="user profile"></a>
                <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                  <li><a class="dropdown-item" href="#">
                      <?php echo $this->session->userdata('firstname'); ?>
                    </a></li>
                  <li><a class="dropdown-item" href="#">Account</a></li>
                  <li><a class="dropdown-item" href="<?php echo base_url('home/apiKey'); ?>">API Key</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="<?php echo base_url("login/logout"); ?>">Log Out</a></li>
                </ul>
              </div>
              <!--//app-user-dropdown-->
            </div>
            <!--//app-utilities-->
          </div>
          <!--//row-->
        </div>
        <!--//app-header-content-->
      </div>
      <!--//container-fluid-->
    </div>
    <!--//app-header-inner-->
    <div id="app-sidepanel" class="app-sidepanel sidepanel-hidden">
      <div id="sidepanel-drop" class="sidepanel-drop"></div>
      <div class="sidepanel-inner d-flex flex-column">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="app-branding">
          <a class="" href="<?php echo base_url(); ?>">
            <!--begin::Svg Icon | path: assets/media/icons/duotune/communication/com011.svg-->
            <span class="svg-icon svg-icon-danger svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none">
                <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor" />
                <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor" />
              </svg></span>
            <!--end::Svg Icon--><span class="logo-text"> UCCFS SMS </span>
          </a>

        </div>
        <!--//app-branding-->
        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
          <ul class="app-menu list-unstyled accordion" id="menu-accordion">
            <li class="nav-item">
              <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
              <a class="nav-link" href="<?php echo base_url(); ?>">
                <span class="nav-icon">
                  <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen001.svg-->
                  <span class="svg-icon  svg-icon-2hx svg-icon-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path d="M11 2.375L2 9.575V20.575C2 21.175 2.4 21.575 3 21.575H9C9.6 21.575 10 21.175 10 20.575V14.575C10 13.975 10.4 13.575 11 13.575H13C13.6 13.575 14 13.975 14 14.575V20.575C14 21.175 14.4 21.575 15 21.575H21C21.6 21.575 22 21.175 22 20.575V9.575L13 2.375C12.4 1.875 11.6 1.875 11 2.375Z" fill="currentColor" />
                    </svg></span>
                  <!--end::Svg Icon-->
                </span>
                <span class="nav-link-text">Dashboard</span>
              </a>
              <!--//nav-link-->
            </li>
            <!--//nav-item-->
            <li class="nav-item">
              <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
              <a class="nav-link" href="<?php echo base_url('messages'); ?>">
                <span class="nav-icon">
                  <!--begin::Svg Icon | path: assets/media/icons/duotune/communication/com012.svg-->
                  <span class="svg-icon svg-icon-primary svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path opacity="0.3" d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z" fill="currentColor" />
                      <rect x="6" y="12" width="7" height="2" rx="1" fill="currentColor" />
                      <rect x="6" y="7" width="12" height="2" rx="1" fill="currentColor" />
                    </svg></span>
                  <!--end::Svg Icon-->
                </span>
                <span class="nav-link-text">Outbox Messages</span>
              </a>
              <!--//nav-link-->
            </li>
            <!--//nav-item-->
            <li class="nav-item">
              <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
              <a class="nav-link" href="<?php echo base_url('home/transactions'); ?>">
                <span class="nav-icon">
                  <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr034.svg-->
                  <span class="svg-icon svg-icon-primary svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path d="M17.4 7H4C3.4 7 3 7.4 3 8C3 8.6 3.4 9 4 9H17.4V7ZM6.60001 15H20C20.6 15 21 15.4 21 16C21 16.6 20.6 17 20 17H6.60001V15Z" fill="currentColor" />
                      <path opacity="0.3" d="M17.4 3V13L21.7 8.70001C22.1 8.30001 22.1 7.69999 21.7 7.29999L17.4 3ZM6.6 11V21L2.3 16.7C1.9 16.3 1.9 15.7 2.3 15.3L6.6 11Z" fill="currentColor" />
                    </svg></span>
                  <!--end::Svg Icon-->
                </span>
                <span class="nav-link-text">Incomes Report</span>
              </a>
              <!--//nav-link-->
            </li>
            <!--//nav-item-->
            <li class="nav-item">
              <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
              <a class="nav-link" href="<?php echo base_url('users'); ?>">
                <span class="nav-icon">
                  <!--begin::Svg Icon | path: assets/media/icons/duotune/communication/com005.svg-->
                  <span class="svg-icon svg-icon-primary svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z" fill="currentColor" />
                      <path opacity="0.3" d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z" fill="currentColor" />
                    </svg></span>
                  <!--end::Svg Icon-->
                </span>
                <span class="nav-link-text">Onboarded SACCOS</span>
              </a>
              <!--//nav-link-->
            </li>
            <hr>

            <li class="nav-item has-submenu" style="display:none">
              <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
              <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-2" aria-expanded="false" aria-controls="submenu-2">
                <span class="nav-icon">
                  <!--begin::Svg Icon | path: assets/media/icons/duotune/coding/cod001.svg-->
                  <span class="svg-icon svg-icon-primary svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path opacity="0.3" d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z" fill="currentColor" />
                      <path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z" fill="currentColor" />
                    </svg></span>
                  <!--end::Svg Icon-->
                </span>
                <span class="nav-link-text">Admin</span>
                <span class="submenu-arrow">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                  </svg>
                </span>
                <!--//submenu-arrow-->
              </a>
              <!--//nav-link-->
              <div id="submenu-2" class="collapse submenu submenu-2" data-bs-parent="#menu-accordion">
                <ul class="submenu-list list-unstyled">
                  <li class="submenu-item"><a class="submenu-link" href="<?php echo base_url('users'); ?>">Users</a></li>
                  <li class="submenu-item"><a class="submenu-link" href="#">Reports</a></li>

                </ul>
              </div>
            </li>
            <!--//nav-item-->

          </ul>
        </nav>
        <div class="app-sidepanel-footer">
          <nav class="app-nav app-nav-footer">
            <ul class="app-menu footer-menu list-unstyled">
              <!--//nav-item-->
              <li class="nav-item" style="display:none">
                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                <a class="nav-link" href="<?php echo base_url('home/apiKey'); ?>">
                  <span class=" nav-icon">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen047.svg-->
                    <span class="svg-icon svg-icon-primary svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                        <path d="M15.8054 11.639C15.6757 11.5093 15.5184 11.4445 15.3331 11.4445H15.111V10.1111C15.111 9.25927 14.8055 8.52784 14.1944 7.91672C13.5833 7.30557 12.8519 7 12 7C11.148 7 10.4165 7.30557 9.80547 7.9167C9.19432 8.52784 8.88885 9.25924 8.88885 10.1111V11.4445H8.66665C8.48153 11.4445 8.32408 11.5093 8.19444 11.639C8.0648 11.7685 8 11.926 8 12.1112V16.1113C8 16.2964 8.06482 16.4539 8.19444 16.5835C8.32408 16.7131 8.48153 16.7779 8.66665 16.7779H15.3333C15.5185 16.7779 15.6759 16.7131 15.8056 16.5835C15.9351 16.4539 16 16.2964 16 16.1113V12.1112C16.0001 11.926 15.9351 11.7686 15.8054 11.639ZM13.7777 11.4445H10.2222V10.1111C10.2222 9.6204 10.3958 9.20138 10.7431 8.85421C11.0903 8.507 11.5093 8.33343 12 8.33343C12.4909 8.33343 12.9097 8.50697 13.257 8.85421C13.6041 9.20135 13.7777 9.6204 13.7777 10.1111V11.4445Z" fill="currentColor" />
                      </svg></span>
                    <!--end::Svg Icon-->
                  </span>
                  <span class="nav-link-text">API Key</span>
                </a>
                <!--//nav-link-->
              </li>
              <!--//nav-item-->
              <li class="nav-item" style="display:none">
                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                <a class="nav-link" href="https://documenter.getpostman.com/view/9379990/UzXM1Jqt" target="_blank" title="Click here to access the docs">
                  <span class=" nav-icon">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/coding/cod003.svg-->
                    <span class="svg-icon svg-icon-primary svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M16.95 18.9688C16.75 18.9688 16.55 18.8688 16.35 18.7688C15.85 18.4688 15.75 17.8688 16.05 17.3688L19.65 11.9688L16.05 6.56876C15.75 6.06876 15.85 5.46873 16.35 5.16873C16.85 4.86873 17.45 4.96878 17.75 5.46878L21.75 11.4688C21.95 11.7688 21.95 12.2688 21.75 12.5688L17.75 18.5688C17.55 18.7688 17.25 18.9688 16.95 18.9688ZM7.55001 18.7688C8.05001 18.4688 8.15 17.8688 7.85 17.3688L4.25001 11.9688L7.85 6.56876C8.15 6.06876 8.05001 5.46873 7.55001 5.16873C7.05001 4.86873 6.45 4.96878 6.15 5.46878L2.15 11.4688C1.95 11.7688 1.95 12.2688 2.15 12.5688L6.15 18.5688C6.35 18.8688 6.65 18.9688 6.95 18.9688C7.15 18.9688 7.35001 18.8688 7.55001 18.7688Z" fill="currentColor" />
                        <path opacity="0.3" d="M10.45 18.9687C10.35 18.9687 10.25 18.9687 10.25 18.9687C9.75 18.8687 9.35 18.2688 9.55 17.7688L12.55 5.76878C12.65 5.26878 13.25 4.8687 13.75 5.0687C14.25 5.1687 14.65 5.76878 14.45 6.26878L11.45 18.2688C11.35 18.6688 10.85 18.9687 10.45 18.9687Z" fill="currentColor" />
                      </svg></span>
                    <!--end::Svg Icon-->
                  </span>
                  <span class="nav-link-text">API Docs</span>
                </a>
                <!--//nav-link-->
              </li>
              <!--//nav-item-->
              <li class="nav-item">
                <!--//Bootstrap Icons: https://icons.getbootstrap.com/ -->
                <a class="nav-link" href="<?php echo base_url("login/logout"); ?>">
                  <span class=" nav-icon">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr077.svg-->
                    <span class="svg-icon svg-icon-primary svg-icon-2hx"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.3" x="4" y="11" width="12" height="2" rx="1" fill="currentColor" />
                        <path d="M5.86875 11.6927L7.62435 10.2297C8.09457 9.83785 8.12683 9.12683 7.69401 8.69401C7.3043 8.3043 6.67836 8.28591 6.26643 8.65206L3.34084 11.2526C2.89332 11.6504 2.89332 12.3496 3.34084 12.7474L6.26643 15.3479C6.67836 15.7141 7.3043 15.6957 7.69401 15.306C8.12683 14.8732 8.09458 14.1621 7.62435 13.7703L5.86875 12.3073C5.67684 12.1474 5.67684 11.8526 5.86875 11.6927Z" fill="currentColor" />
                        <path d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6C10 5.44772 10.4477 5 11 5H18C18.5523 5 19 5.44772 19 6V18C19 18.5523 18.5523 19 18 19H11C10.4477 19 10 18.5523 10 18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 20.1046 8.89543 21 10 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H10C8.89543 3 8 3.89543 8 5Z" fill="#C4C4C4" />
                      </svg></span>
                    <!--end::Svg Icon-->
                  </span>
                  <span class="nav-link-text">Log Out</span>
                </a>
                <!--//nav-link-->
              </li>
            </ul>
            <!--//footer-menu-->
          </nav>
        </div>
        <!--//app-sidepanel-footer-->
      </div>

    </div>
    <!--//sidepanel-inner-->
    </div>
    <!--//app-sidepanel-->
  </header>
  <!--//app-header-->

  <div class="app-wrapper">

    <div class="app-content pt-3 p-md-3 p-lg-4">
      <div class="container-xl">
        <?php
        echo $this->template->content;
        ?>
      </div>
      <!--//container-fluid-->
    </div>
    <!--//app-content-->

    <footer class="app-footer ">
      <div class="container text-center py-3">
        <small class="copyright">Developed by &copy; <?php echo date('Y'); ?> UCCFS - All Rights Reserved</small>
      </div>
    </footer>
    <!--//app-footer -->
  </div>
  <!--//app-wrapper -->

  <!-- Javascript -->

  <script src="<?php echo base_url("assets/plugins/popper.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/plugins/bootstrap/js/bootstrap.min.js"); ?>"></script>

  <!-- Page Specific JS -->
  <script src="<?php echo base_url("assets/js/app.js"); ?>"></script>
  <!-- Data tables -->
  <script src="<?php echo base_url("assets/js/plugins/dataTables/jquery.dataTables.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/js/plugins/dataTables/dataTables.bootstrap5.min.js"); ?>"></script>
  <script src="<?php echo base_url("assets/js/plugins/dataTables/dataTables.fixedColumns.min.js"); ?>"></script>
  <!-- Sweet alert -->
  <script src="<?php echo base_url("assets/js/plugins/sweetalert/sweetalert.min.js"); ?>"></script>
  <!-- Toastr script -->
  <script src="<?php echo base_url("assets/js/plugins/toastr/toastr.min.js"); ?>"></script>

  <!-- Bootstrap validator script -->
  <script src="<?php echo base_url("assets/js/plugins/validate/validator.min.js"); ?>"></script>
  <!-- Moment JScript -->
  <script src="<?php echo base_url("assets/js/plugins/moment/moment.min.js"); ?>"></script>
  <!-- Moment JScript -->
  <script src="<?php echo base_url("assets/js/plugins/datepicker/bootstrap-datepicker.js"); ?>"></script>
  <!-- Knockout Jscript -->
  <script src="<?php echo base_url("assets/js/plugins/knockout/knockout-3.4.2.js"); ?>"></script>

  <!-- Page specific javascripts-->
  <?php echo $this->template->javascript; ?>

  <script>
    $(document).ready(function() {

      $.ajax({
        url: '<?php echo api_url . "/utils/totalFloatBalance"; ?>',
        headers: {
          Authorization: 'Bearer ' + '<?php echo $this->session->userdata('auth_token'); ?>'
        },
        dataType: 'json',
        success: function(feedback) {
          if (feedback.success) {
            viewModel.balance(feedback.data.acc_balance);
            viewModel.sms_cost(feedback.cost);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {

        }
      });

      $.ajax({
        url: '<?php echo api_url . "/utils/get_total_connected_saccos"; ?>',
        headers: {
          Authorization: 'Bearer ' + '<?php echo $this->session->userdata('auth_token'); ?>'
        },
        dataType: 'json',
        success: function(feedback) {
          if (feedback.success) {
            console.log("---------------------");
            console.log(feedback.data[0].total);
            console.log("---------------------");
            viewModel.totalconnected(feedback.data[0].total);
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(jqXHR, errorThrown);
        }
      });
    });
  </script>
  <?php $this->view('includes/helpers'); ?>
</body>

</html>