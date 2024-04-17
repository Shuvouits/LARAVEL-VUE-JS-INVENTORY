<script>
import Logo from "../assets/image/logo.png";
import LogoWhite from "../assets/image/logo-white.png";
import LogoSmall from "../assets/image/logo-small.png";
import Avatar1 from "../assets/image/avator1.jpg";
import Avatar01 from "../assets/image/avatar-01.jpg";
import Avatar10 from "../assets/image/avatar-10.jpg";
import Store01 from "../assets/image/store-01.png";
import Store02 from "../assets/image/store-02.png";
import FR from "../assets/image/fr.png";

export default {
  computed: {
    Logo() {
      return Logo;
    },

    LogoWhite() {
      return LogoWhite;
    },

    LogoSmall() {
      return LogoSmall;
    },

    Avatar1() {
      return Avatar1;
    },

    Avatar01() {
      return Avatar01;
    },

    Avatar10() {
      return Avatar10;
    },

    Store01() {
      return Store01;
    },

    Store02() {
      return Store02;
    },

    FR() {
      return FR;
    },
  },
};
</script>

<template>
  <div class="header">
    <div class="header-left active">
      <a href="index.html" class="logo logo-normal">
        <img :src="Logo" alt />
      </a>
      <a href="index.html" class="logo logo-white">
        <img :src="LogoWhite" alt />
      </a>
      <a href="index.html" class="logo-small">
        <img :src="LogoPng" alt />
      </a>
      <a id="toggle_btn" href="javascript:void(0);">
        <i data-feather="chevrons-left" class="feather-16"></i>
      </a>
    </div>

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
      <span class="bar-icon">
        <span></span>
        <span></span>
        <span></span>
      </span>
    </a>

    <ul class="nav user-menu">
      <li class="nav-item nav-searchinputs">
        <div class="top-nav-search">
          <a href="javascript:void(0);" class="responsive-search">
            <i class="fa fa-search"></i>
          </a>
          <form action="#" class="dropdown">
            <div
              class="searchinputs dropdown-toggle"
              id="dropdownMenuClickable"
              data-bs-toggle="dropdown"
              data-bs-auto-close="false"
            >
              <input type="text" placeholder="Search" />
              <div class="search-addon">
                <span><i data-feather="x-circle" class="feather-14"></i></span>
              </div>
            </div>
            <div
              class="dropdown-menu search-dropdown"
              aria-labelledby="dropdownMenuClickable"
            >
              <div class="search-info">
                <h6>
                  <span><i data-feather="search" class="feather-16"></i></span
                  >Recent Searches
                </h6>
                <ul class="search-tags">
                  <li><a href="javascript:void(0);">Products</a></li>
                  <li><a href="javascript:void(0);">Sales</a></li>
                  <li><a href="javascript:void(0);">Applications</a></li>
                </ul>
              </div>
              <div class="search-info">
                <h6>
                  <span
                    ><i data-feather="help-circle" class="feather-16"></i></span
                  >Help
                </h6>
                <p>
                  How to Change Product Volume from 0 to 200 on Inventory
                  management
                </p>
                <p>Change Product Name</p>
              </div>
              <div class="search-info">
                <h6>
                  <span><i data-feather="user" class="feather-16"></i></span
                  >Customers
                </h6>
                <ul class="customers">
                  <li>
                    <a href="javascript:void(0);"
                      >Aron Varu<img :src="Avator1" alt class="img-fluid"
                    /></a>
                  </li>
                  <li>
                    <a href="javascript:void(0);"
                      >Jonita<img :src="Avatar01" alt class="img-fluid"
                    /></a>
                  </li>
                  <li>
                    <a href="javascript:void(0);"
                      >Aaron<img :src="Avatar10.jpg" alt class="img-fluid"
                    /></a>
                  </li>
                </ul>
              </div>
            </div>
          </form>
        </div>
      </li>

      <li class="nav-item dropdown has-arrow main-drop select-store-dropdown">
        <a
          href="javascript:void(0);"
          class="dropdown-toggle nav-link select-store"
          data-bs-toggle="dropdown"
        >
          <span class="user-info">
            <span class="user-letter">
              <img :src="Store01.png" alt="Store Logo" class="img-fluid" />
            </span>
            <span class="user-detail">
              <span class="user-name">Select Store</span>
            </span>
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a href="javascript:void(0);" class="dropdown-item">
            <img :src="Store01" alt="Store Logo" class="img-fluid" /> Grocery
            Alpha
          </a>
          <a href="javascript:void(0);" class="dropdown-item">
            <img :src="store01" alt="Store Logo" class="img-fluid" /> Grocery
            Apex
          </a>
          <a href="javascript:void(0);" class="dropdown-item">
            <img :src="Store01" alt="Store Logo" class="img-fluid" /> Grocery
            Bevy
          </a>
          <a href="javascript:void(0);" class="dropdown-item">
            <img :src="Store01" alt="Store Logo" class="img-fluid" /> Grocery
            Eden
          </a>
        </div>
      </li>

      <li class="nav-item dropdown has-arrow flag-nav nav-item-box">
        <a
          class="nav-link dropdown-toggle"
          data-bs-toggle="dropdown"
          href="javascript:void(0);"
          role="button"
        >
          <img :src="FR" alt="Language" class="img-fluid" />
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <a href="javascript:void(0);" class="dropdown-item active">
            <img :src="FR" alt height="16" /> English
          </a>
          <a href="javascript:void(0);" class="dropdown-item">
            <img :src="FR" alt height="16" /> French
          </a>
          <a href="javascript:void(0);" class="dropdown-item">
            <img :src="FR" alt height="16" /> Spanish
          </a>
          <a href="javascript:void(0);" class="dropdown-item">
            <img :src="FR" alt height="16" /> German
          </a>
        </div>
      </li>

      <li class="nav-item nav-item-box">
        <a href="javascript:void(0);" id="btnFullscreen">
          <i data-feather="maximize"></i>
        </a>
      </li>
      <li class="nav-item nav-item-box">
        <a href="email.html">
          <i data-feather="mail"></i>
          <span class="badge rounded-pill">1</span>
        </a>
      </li>

      <li class="nav-item dropdown nav-item-box">
        <a
          href="javascript:void(0);"
          class="dropdown-toggle nav-link"
          data-bs-toggle="dropdown"
        >
          <i data-feather="bell"></i><span class="badge rounded-pill">2</span>
        </a>
        <div class="dropdown-menu notifications">
          <div class="topnav-dropdown-header">
            <span class="notification-title">Notifications</span>
            <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
          </div>
          <div class="noti-content">
            <ul class="notification-list">
              <li class="notification-message">
                <a href="activities.html">
                  <div class="media d-flex">
                    <span class="avatar flex-shrink-0">
                      <img alt :src="Avatar01.jpg" />
                    </span>
                    <div class="media-body flex-grow-1">
                      <p class="noti-details">
                        <span class="noti-title">John Doe</span> added new task
                        <span class="noti-title"
                          >Patient appointment booking</span
                        >
                      </p>
                      <p class="noti-time">
                        <span class="notification-time">4 mins ago</span>
                      </p>
                    </div>
                  </div>
                </a>
              </li>
              <li class="notification-message">
                <a href="activities.html">
                  <div class="media d-flex">
                    <span class="avatar flex-shrink-0">
                      <img alt :src="Avatar01" />
                    </span>
                    <div class="media-body flex-grow-1">
                      <p class="noti-details">
                        <span class="noti-title">Tarah Shropshire</span>
                        changed the task name
                        <span class="noti-title"
                          >Appointment booking with payment gateway</span
                        >
                      </p>
                      <p class="noti-time">
                        <span class="notification-time">6 mins ago</span>
                      </p>
                    </div>
                  </div>
                </a>
              </li>
              <li class="notification-message">
                <a href="activities.html">
                  <div class="media d-flex">
                    <span class="avatar flex-shrink-0">
                      <img alt :src="Avatar01" />
                    </span>
                    <div class="media-body flex-grow-1">
                      <p class="noti-details">
                        <span class="noti-title">Misty Tison</span> added
                        <span class="noti-title">Domenic Houston</span> and
                        <span class="noti-title">Claire Mapes</span> to project
                        <span class="noti-title">Doctor available module</span>
                      </p>
                      <p class="noti-time">
                        <span class="notification-time">8 mins ago</span>
                      </p>
                    </div>
                  </div>
                </a>
              </li>

              <li class="notification-message">
                <a href="activities.html">
                  <div class="media d-flex">
                    <span class="avatar flex-shrink-0">
                      <img alt :src="Avatar01" />
                    </span>
                    <div class="media-body flex-grow-1">
                      <p class="noti-details">
                        <span class="noti-title">Rolland Webber</span>
                        completed task
                        <span class="noti-title"
                          >Patient and Doctor video conferencing</span
                        >
                      </p>
                      <p class="noti-time">
                        <span class="notification-time">12 mins ago</span>
                      </p>
                    </div>
                  </div>
                </a>
              </li>
              <li class="notification-message">
                <a href="activities.html">
                  <div class="media d-flex">
                    <span class="avatar flex-shrink-0">
                      <img alt :src="Avatar01" />
                    </span>
                    <div class="media-body flex-grow-1">
                      <p class="noti-details">
                        <span class="noti-title">Bernardo Galaviz</span> added
                        new task
                        <span class="noti-title">Private chat module</span>
                      </p>
                      <p class="noti-time">
                        <span class="notification-time">2 days ago</span>
                      </p>
                    </div>
                  </div>
                </a>
              </li>
            </ul>
          </div>
          <div class="topnav-dropdown-footer">
            <a href="activities.html">View all Notifications</a>
          </div>
        </div>
      </li>

      <li class="nav-item nav-item-box">
        <a href="general-settings.html"><i data-feather="settings"></i></a>
      </li>
      <li class="nav-item dropdown has-arrow main-drop">
        <a
          href="javascript:void(0);"
          class="dropdown-toggle nav-link userset"
          data-bs-toggle="dropdown"
        >
          <span class="user-info">
            <span class="user-letter">
              <img :src="Avatar01" alt class="img-fluid" />
            </span>
            <span class="user-detail">
              <span class="user-name">John Smilga</span>
              <span class="user-role">Super Admin</span>
            </span>
          </span>
        </a>
        <div class="dropdown-menu menu-drop-user">
          <div class="profilename">
            <div class="profileset">
              <span class="user-img"
                ><img :src="Avatar01" alt /> <span class="status online"></span
              ></span>
              <div class="profilesets">
                <h6>John Smilga</h6>
                <h5>Super Admin</h5>
              </div>
            </div>
            <hr class="m-0" />
            <a class="dropdown-item" href="profile.html">
              <i class="me-2" data-feather="user"></i> My Profile</a
            >
            <a class="dropdown-item" href="general-settings.html"
              ><i class="me-2" data-feather="settings"></i>Settings</a
            >
            <hr class="m-0" />
            <a class="dropdown-item logout pb-0" href="signin.html">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="feather feather-log-out"
              >
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
              </svg>

              Logout
            </a>
          </div>
        </div>
      </li>
    </ul>

    <div class="dropdown mobile-user-menu">
      <a
        href="javascript:void(0);"
        class="nav-link dropdown-toggle"
        data-bs-toggle="dropdown"
        aria-expanded="false"
        ><i class="fa fa-ellipsis-v"></i
      ></a>
      <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="profile.html">My Profile</a>
        <a class="dropdown-item" href="general-settings.html">Settings</a>
        <a class="dropdown-item" href="signin.html">Logout</a>
      </div>
    </div>
  </div>
</template>