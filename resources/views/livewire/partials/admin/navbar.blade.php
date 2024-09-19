  <!-- Navbar -->

 <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="container-xxl">
              <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                  <i class="bx bx-menu bx-sm"></i>
                </a>
              </div>

              <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                <div class="navbar-nav align-items-center">
                  <div class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                      <i class="bx bx-sm"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-start dropdown-styles">
                      <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                          <span class="align-middle"><i class="bx bx-sun me-2"></i>Light</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                          <span class="align-middle"><i class="bx bx-moon me-2"></i>Dark</span>
                        </a>
                      </li>
                      <li>
                        <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                          <span class="align-middle"><i class="bx bx-desktop me-2"></i>System</span>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>

                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <!-- User -->
                    <li class="nav-item navbar-dropdown dropdown-user dropdown">
                      <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                          <img src="{{ asset('style/images/setting.jpg') }}" alt class="rounded-circle" />
                        </div>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                          <a class="dropdown-item" href="#">
                            <div class="d-flex">
                              <div class="flex-shrink-0 me-3">
                                <div class="avatar avatar-online">
                                  <img src="{{ asset('style/images/setting.jpg') }}" alt class="rounded-circle" />
                                </div>
                              </div>
                              <div class="flex-grow-1">
                                <!-- Display Authenticated User's Name -->
                                <span class="fw-medium d-block lh-1">{{ Auth::user()->name }}</span>
                                <small>{{ Auth::user()->role ?? 'User' }}</small>
                              </div>
                            </div>
                          </a>
                        </li>


                        <li>
                          <div class="dropdown-divider"></div>
                        </li>
                        <li>
                          <!-- Logout Button -->
                          <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                              <i class="bx bx-power-off me-2"></i>
                              <span class="align-middle">تسجيل الخروج</span>
                            </button>
                          </form>
                        </li>
                      </ul>
                    </li>
                  </ul>

                  </li>
                  <!--/ User -->
                </ul>
              </div>
            </div>
          </nav>

          <!-- / Navbar -->

