<?php
// Current Full URL
$fullPagePath = Request::url();
// Char Count of Backend folder Plus 1
$envAdminCharCount = strlen(env('BACKEND_PATH')) + 1;
// URL after Root Path EX: admin/home
$urlAfterRoot = substr($fullPagePath, strpos($fullPagePath, env('BACKEND_PATH')) + $envAdminCharCount);
$mnu_title_var = "title_" . @Helper::currentLanguage()->code;
$mnu_title_var2 = "title_" . env('DEFAULT_LANGUAGE');
?>

<div id="aside" class="app-aside modal fade folded md nav-expand">
    <div class="left navside dark dk" layout="column">
        <div class="navbar navbar-md no-radius" >
            <!-- brand -->
            <a class="navbar-brand" href="{{ route('adminHome') }}">
{{--                <img src="{{ asset('assets/dashboard/images/logo.png') }}" alt="Control">--}}
                <span class="hidden-folded inline">Bookfei</span>
            </a>
            <!-- / brandsss -->
        </div>
        <div flex class="hide-scroll">
            <nav class="scroll nav-active-primary">

                <ul class="nav" ui-nav>
                    <li class="nav-header hidden-folded">
                        <small class="text-muted">{{ __('backend.main') }}</small>
                    </li>

                    <li>
                        <a href="{{ route('adminHome') }}" onclick="location.href='{{ route('adminHome') }}'">
                  <span class="nav-icon">
                    <i class="material-icons">&#xe3fc;</i>
                  </span>
                            <span class="nav-text">{{ __('backend.dashboard') }}</span>
                        </a>
                    </li>


                    @if (env('GEOIP_STATUS', false))
                        @if(Helper::GeneralWebmasterSettings("analytics_status"))
                            @if(@Auth::user()->permissionsGroup->analytics_status)
                                <?php
                                $currentFolder = "analytics"; // Put folder name here
                                $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));

                                $currentFolder2 = "ip"; // Put folder name here
                                $PathCurrentFolder2 = substr($urlAfterRoot, 0, strlen($currentFolder2));

                                $currentFolder3 = "visitors"; // Put folder name here
                                $PathCurrentFolder3 = substr($urlAfterRoot, 0, strlen($currentFolder3));
                                ?>
                                <li {{ ($PathCurrentFolder==$currentFolder || $PathCurrentFolder2==$currentFolder2  || $PathCurrentFolder3==$currentFolder3) ? 'class=active' : '' }}>
                                    <a>
                  <span class="nav-caret">
                    <i class="fa fa-caret-down"></i>
                  </span>
                                        <span class="nav-icon">
                    <i class="material-icons">&#xe1b8;</i>
                  </span>
                                        <span class="nav-text">{{ __('backend.visitorsAnalytics') }}</span>
                                    </a>
                                    <ul class="nav-sub">
                                        <li>
                                            <a onclick="location.href='{{ route('analytics', 'date') }}'">
                                            <span
                                                class="nav-text">{{ __('backend.visitorsAnalyticsBydate') }}</span>
                                            </a>
                                        </li>

                                        <?php
                                        $currentFolder = "analytics/country"; // Put folder name here
                                        $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                        ?>
                                        <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                            <a onclick="location.href='{{ route('analytics', 'country') }}'">
                                            <span
                                                class="nav-text">{{ __('backend.visitorsAnalyticsByCountry') }}</span>
                                            </a>
                                        </li>

                                        <?php
                                        $currentFolder = "analytics/city"; // Put folder name here
                                        $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                        ?>
                                        <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                            <a onclick="location.href='{{ route('analytics', 'city') }}'">
                                            <span
                                                class="nav-text">{{ __('backend.visitorsAnalyticsByCity') }}</span>
                                            </a>
                                        </li>

                                        <?php
                                        $currentFolder = "analytics/os"; // Put folder name here
                                        $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                        ?>
                                        <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                            <a onclick="location.href='{{ route('analytics', 'os') }}'">
                                            <span
                                                class="nav-text">{{ __('backend.visitorsAnalyticsByOperatingSystem') }}</span>
                                            </a>
                                        </li>

                                        <?php
                                        $currentFolder = "analytics/browser"; // Put folder name here
                                        $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                        ?>
                                        <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                            <a onclick="location.href='{{ route('analytics', 'browser') }}'">
                                            <span
                                                class="nav-text">{{ __('backend.visitorsAnalyticsByBrowser') }}</span>
                                            </a>
                                        </li>

                                        <?php
                                        $currentFolder = "analytics/referrer"; // Put folder name here
                                        $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                        ?>
                                        <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                            <a onclick="location.href='{{ route('analytics', 'referrer') }}'">
                                            <span
                                                class="nav-text">{{ __('backend.visitorsAnalyticsByReachWay') }}</span>
                                            </a>
                                        </li>
                                        <?php
                                        $currentFolder = "analytics/hostname"; // Put folder name here
                                        $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                        ?>
                                        <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                            <a onclick="location.href='{{ route('analytics', 'hostname') }}'">
                                            <span
                                                class="nav-text">{{ __('backend.visitorsAnalyticsByHostName') }}</span>
                                            </a>
                                        </li>
                                        <?php
                                        $currentFolder = "analytics/org"; // Put folder name here
                                        $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                        ?>
                                        <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                            <a onclick="location.href='{{ route('analytics', 'org') }}'">
                                            <span
                                                class="nav-text">{{ __('backend.visitorsAnalyticsByOrganization') }}</span>
                                            </a>
                                        </li>
                                        <?php
                                        $currentFolder = "visitors"; // Put folder name here
                                        $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                        ?>
                                        <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                            <a onclick="location.href='{{ route('visitors') }}'">
                                            <span
                                                class="nav-text">{{ __('backend.visitorsAnalyticsVisitorsHistory') }}</span>
                                            </a>
                                        </li>
                                        <?php
                                        $currentFolder = "ip"; // Put folder name here
                                        $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                        ?>
                                        <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                            <a href="{{ route('visitorsIP') }}">
                                            <span
                                                class="nav-text">{{ __('backend.visitorsAnalyticsIPInquiry') }}</span>
                                            </a>
                                        </li>


                                    </ul>
                                </li>
                            @endif
                        @endif
                    @endif
                    @if(Helper::GeneralWebmasterSettings("newsletter_status"))
                        @if(@Auth::user()->permissionsGroup->newsletter_status)
                            <?php
                            $currentFolder = "contacts"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('contacts') }}">
<span class="nav-icon">
<i class="material-icons">&#xe7ef;</i>
</span>
                                    <span class="nav-text">{{ __('backend.newsletter') }}</span>
                                </a>
                            </li>
                        @endif
                    @endif
                    @if(Helper::GeneralWebmasterSettings("inbox_status"))
                        @if(@Auth::user()->permissionsGroup->inbox_status)
                            <?php
                            $currentFolder = "webmails"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('admin.tour.list') }}">
                  <span class="nav-icon">
<i class="fa fa-car" aria-hidden="true"></i>
                  </span>
                                    <span class="nav-text">{{ __('backend.tours') }}
                                        @if( @$webmailsNewCount >0)
                                            <badge class="label warn m-l-xs">{{ @$webmailsNewCount }}</badge>
                                        @endif
                                    </span>

                                </a>
                            </li>
                        @endif
                    @endif
                    @if(Helper::GeneralWebmasterSettings("inbox_status"))
                        @if(@Auth::user()->permissionsGroup->inbox_status)
                            <?php
                            $currentFolder = "webmails"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('admin.travel_product.list') }}">
                  <span class="nav-icon">
<i class="fa fa-product-hunt" aria-hidden="true"></i>
                  </span>
                                    <span class="nav-text">{{ __('backend.travel_products') }}
                                        @if( @$webmailsNewCount >0)
                                            <badge class="label warn m-l-xs">{{ @$webmailsNewCount }}</badge>
                                        @endif
                                    </span>

                                </a>
                            </li>
                        @endif
                    @endif
                    @if(Helper::GeneralWebmasterSettings("inbox_status"))
                        @if(@Auth::user()->permissionsGroup->inbox_status)
                            <?php
                            $currentFolder = "webmails"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('admin.offer.list') }}">
                  <span class="nav-icon">
<i class="fa fa-american-sign-language-interpreting" aria-hidden="true"></i>
                  </span>
                                    <span class="nav-text">{{ __('backend.offers') }}
                                        @if( @$webmailsNewCount >0)
                                            <badge class="label warn m-l-xs">{{ @$webmailsNewCount }}</badge>
                                        @endif
                                    </span>

                                </a>
                            </li>
                        @endif
                    @endif
                    @if(Helper::GeneralWebmasterSettings("inbox_status"))
                        @if(@Auth::user()->permissionsGroup->inbox_status)
                            <?php
                            $currentFolder = "webmails"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('admin.hotel.list') }}">
                  <span class="nav-icon">
<i class="fa fa-home" aria-hidden="true"></i>
                  </span>
                                    <span class="nav-text">{{ __('backend.hotels') }}
                                        @if( @$webmailsNewCount >0)
                                            <badge class="label warn m-l-xs">{{ @$webmailsNewCount }}</badge>
                                        @endif
                                    </span>

                                </a>
                            </li>
                        @endif
                    @endif
                    @if(Helper::GeneralWebmasterSettings("inbox_status"))
                        @if(@Auth::user()->permissionsGroup->inbox_status)
                            <?php
                            $currentFolder = "webmails"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('admin.cruiseLine.list') }}">
                  <span class="nav-icon">
<i class="fa fa-ship" aria-hidden="true"></i>
                  </span>
                                    <span class="nav-text">{{ __('backend.cruiseLines') }}
                                        @if( @$webmailsNewCount >0)
                                            <badge class="label warn m-l-xs">{{ @$webmailsNewCount }}</badge>
                                        @endif
                                    </span>

                                </a>
                            </li>
                                <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                    <a href="{{ route('admin.cruiseShip.list') }}">
                  <span class="nav-icon">
<i class="fa fa-ship" aria-hidden="true"></i>
                  </span>
                                        <span class="nav-text">Cruise Ships
                                            @if( @$webmailsNewCount >0)
                                                <badge class="label warn m-l-xs">{{ @$webmailsNewCount }}</badge>
                                            @endif
                                    </span>

                                    </a>
                                </li>
                        @endif
                    @endif
                    @if(Helper::GeneralWebmasterSettings("inbox_status"))
                        @if(@Auth::user()->permissionsGroup->inbox_status)
                            <?php
                            $currentFolder = "webmails"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('admin.airline.list') }}">
                  <span class="nav-icon">
<i class="fa fa-rocket" aria-hidden="true"></i>
                  </span>
                                    <span class="nav-text">{{ __('backend.airlines') }}
                                        @if( @$webmailsNewCount >0)
                                            <badge class="label warn m-l-xs">{{ @$webmailsNewCount }}</badge>
                                        @endif
                                    </span>

                                </a>
                            </li>
                        @endif
                    @endif
                    @if(Helper::GeneralWebmasterSettings("inbox_status"))
                        @if(@Auth::user()->permissionsGroup->inbox_status)
                            <?php
                            $currentFolder = "webmails"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('admin.airport.list') }}">
                  <span class="nav-icon">
<i class="fa fa-plane" aria-hidden="true"></i>
                  </span>
                                    <span class="nav-text">{{ __('backend.airports') }}
                                        @if( @$webmailsNewCount >0)
                                            <badge class="label warn m-l-xs">{{ @$webmailsNewCount }}</badge>
                                        @endif
                                    </span>

                                </a>
                            </li>
                        @endif
                    @endif
                    @if(Helper::GeneralWebmasterSettings("inbox_status"))
                        @if(@Auth::user()->permissionsGroup->inbox_status)
                            <?php
                            $currentFolder = "webmails"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('admin.supplier.list') }}">
                  <span class="nav-icon">
<i class="fa fa-user-plus" aria-hidden="true"></i>
                  </span>
                                    <span class="nav-text">{{ __('backend.suppliers') }}
                                        @if( @$webmailsNewCount >0)
                                            <badge class="label warn m-l-xs">{{ @$webmailsNewCount }}</badge>
                                        @endif
                                    </span>

                                </a>
                            </li>
                        @endif
                    @endif
                    @if(Helper::GeneralWebmasterSettings("inbox_status"))
                        @if(@Auth::user()->permissionsGroup->inbox_status)
                            <?php
                            $currentFolder = "webmails"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('webmails') }}">
                  <span class="nav-icon">
                    <i class="material-icons">&#xe156;</i>
                  </span>
                                    <span class="nav-text">{{ __('backend.siteInbox') }}
                                        @if( @$webmailsNewCount >0)
                                            <badge class="label warn m-l-xs">{{ @$webmailsNewCount }}</badge>
                                        @endif
                                    </span>

                                </a>
                            </li>
                        @endif
                    @endif

                    @if(Helper::GeneralWebmasterSettings("calendar_status"))
                        @if(@Auth::user()->permissionsGroup->calendar_status)
                            <?php
                            $currentFolder = "calendar"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('calendar') }}" onclick="location.href='{{ route('calendar') }}'">
                  <span class="nav-icon">
                    <i class="material-icons">&#xe5c3;</i>
                  </span>
                                    <span class="nav-text">{{ __('backend.calendar') }}</span>
                                </a>
                            </li>
                        @endif
                    @endif
                    @if(Helper::GeneralWebmasterSettings("inbox_status"))
                        @if(@Auth::user()->permissionsGroup->inbox_status)
                            <?php
                            $currentFolder = "webmails"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('admin.area.list') }}">
                  <span class="nav-icon">
     <i class="fa fa-area-chart" aria-hidden="true"></i>
                  </span>
                                    <span class="nav-text">{{ __('backend.areas') }}
                                        @if( @$webmailsNewCount >0)
                                            <badge class="label warn m-l-xs">{{ @$webmailsNewCount }}</badge>
                                        @endif
                                    </span>

                                </a>
                            </li>
                        @endif
                    @endif
                    @if(Helper::GeneralWebmasterSettings("inbox_status"))
                        @if(@Auth::user()->permissionsGroup->inbox_status)
                            <?php
                            $currentFolder = "webmails"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('admin.country.list') }}">
                  <span class="nav-icon">
     <i class="fa fa-globe" aria-hidden="true"></i>
                  </span>
                                    <span class="nav-text">{{ __('backend.countries') }}
                                        @if( @$webmailsNewCount >0)
                                            <badge class="label warn m-l-xs">{{ @$webmailsNewCount }}</badge>
                                        @endif
                                    </span>

                                </a>
                            </li>
                        @endif
                    @endif
                    @if(Helper::GeneralWebmasterSettings("inbox_status"))
                        @if(@Auth::user()->permissionsGroup->inbox_status)
                            <?php
                            $currentFolder = "webmails"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('admin.city.list') }}">
                  <span class="nav-icon">
                   <i class="fa fa-building" aria-hidden="true"></i>
                  </span>
                                    <span class="nav-text">{{ __('backend.cities') }}
                                        @if( @$webmailsNewCount >0)
                                            <badge class="label warn m-l-xs">{{ @$webmailsNewCount }}</badge>
                                        @endif
                                    </span>

                                </a>
                            </li>
                        @endif
                    @endif
                    @if(Helper::GeneralWebmasterSettings("inbox_status"))
                        @if(@Auth::user()->permissionsGroup->inbox_status)
                            <?php
                            $currentFolder = "webmails"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('admin.currency.list') }}">
                  <span class="nav-icon">
                <i class="fa fa-usd" aria-hidden="true"></i>
                  </span>
                                    <span class="nav-text">{{ __('backend.currencies') }}
                                        @if( @$webmailsNewCount >0)
                                            <badge class="label warn m-l-xs">{{ @$webmailsNewCount }}</badge>
                                        @endif
                                    </span>

                                </a>
                            </li>
                        @endif
                    @endif
                    @if(Helper::GeneralWebmasterSettings("inbox_status"))
                        @if(@Auth::user()->permissionsGroup->inbox_status)
                            <?php
                            $currentFolder = "webmails"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('admin.destination.list') }}">
                  <span class="nav-icon">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                  </span>
                                    <span class="nav-text">{{ __('backend.destinations') }}
                                        @if( @$webmailsNewCount >0)
                                            <badge class="label warn m-l-xs">{{ @$webmailsNewCount }}</badge>
                                        @endif
                                    </span>

                                </a>
                            </li>
                        @endif
                    @endif
                    @if(Helper::GeneralWebmasterSettings("inbox_status"))
                        @if(@Auth::user()->permissionsGroup->inbox_status)
                            <?php
                            $currentFolder = "webmails"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('admin.category.list') }}">
                  <span class="nav-icon">
                <i class="fa fa-database" aria-hidden="true"></i>
                  </span>
                                    <span class="nav-text">{{ __('backend.categories') }}
                                        @if( @$webmailsNewCount >0)
                                            <badge class="label warn m-l-xs">{{ @$webmailsNewCount }}</badge>
                                        @endif
                                    </span>

                                </a>
                            </li>
                        @endif
                    @endif
                    @if(Helper::GeneralWebmasterSettings("inbox_status"))
                        @if(@Auth::user()->permissionsGroup->inbox_status)
                            <?php
                            $currentFolder = "webmails"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                <a href="{{ route('admin.tag.list') }}">
                  <span class="nav-icon">
                <i class="fa fa-tags" aria-hidden="true"></i>
                  </span>
                                    <span class="nav-text">{{ __('backend.tags') }}
                                        @if( @$webmailsNewCount >0)
                                            <badge class="label warn m-l-xs">{{ @$webmailsNewCount }}</badge>
                                        @endif
                                    </span>

                                </a>
                            </li>
                        @endif
                    @endif

                    <li class="nav-header hidden-folded">
                        <small class="text-muted">{{ __('backend.siteData') }}</small>
                    </li>

                    <?php
                    $data_sections_arr = explode(",", Auth::user()->permissionsGroup->data_sections);
                    ?>
{{--                    @foreach($GeneralWebmasterSections as $GeneralWebmasterSection)--}}
{{--                        @if(in_array($GeneralWebmasterSection->id,$data_sections_arr))--}}
{{--                            <?php--}}
{{--                            if ($GeneralWebmasterSection->$mnu_title_var != "") {--}}
{{--                                $GeneralWebmasterSectionTitle = $GeneralWebmasterSection->$mnu_title_var;--}}
{{--                            } else {--}}
{{--                                $GeneralWebmasterSectionTitle = $GeneralWebmasterSection->$mnu_title_var2;--}}
{{--                            }--}}

{{--                            $LiIcon = "&#xe2c8;";--}}
{{--                            if ($GeneralWebmasterSection->type == 3) {--}}
{{--                                $LiIcon = "&#xe050;";--}}
{{--                            }--}}
{{--                            if ($GeneralWebmasterSection->type == 2) {--}}
{{--                                $LiIcon = "&#xe63a;";--}}
{{--                            }--}}
{{--                            if ($GeneralWebmasterSection->type == 1) {--}}
{{--                                $LiIcon = "&#xe251;";--}}
{{--                            }--}}
{{--                            if ($GeneralWebmasterSection->type == 0) {--}}
{{--                                $LiIcon = "&#xe2c8;";--}}
{{--                            }--}}
{{--                            if ($GeneralWebmasterSection->id == 1) {--}}
{{--                                $LiIcon = "&#xe3e8;";--}}
{{--                            }--}}
{{--                            if ($GeneralWebmasterSection->id == 7) {--}}
{{--                                $LiIcon = "&#xe02f;";--}}
{{--                            }--}}
{{--                            if ($GeneralWebmasterSection->id == 2) {--}}
{{--                                $LiIcon = "&#xe540;";--}}
{{--                            }--}}
{{--                            if ($GeneralWebmasterSection->id == 3) {--}}
{{--                                $LiIcon = "&#xe307;";--}}
{{--                            }--}}
{{--                            if ($GeneralWebmasterSection->id == 8) {--}}
{{--                                $LiIcon = "&#xe8f6;";--}}
{{--                            }--}}

{{--                            // get 9 char after root url to check if is "webmaster"--}}
{{--                            $is_webmaster = substr($urlAfterRoot, 0, 9);--}}
{{--                            ?>--}}
{{--                            @if($GeneralWebmasterSection->sections_status > 0 && @Auth::user()->permissionsGroup->view_status == 0)--}}
{{--                                <li {{ ($GeneralWebmasterSection->id == @$WebmasterSection->id && $is_webmaster != "webmaster") ? 'class=active' : '' }}>--}}
{{--                                    <a>--}}
{{--                  <span class="nav-caret">--}}
{{--                    <i class="fa fa-caret-down"></i>--}}
{{--                  </span>--}}
{{--                                        <span class="nav-icon">--}}
{{--                    <i class="material-icons">{!! $LiIcon !!}</i>--}}
{{--                  </span>--}}
{{--                                        <span--}}
{{--                                            class="nav-text">{!! $GeneralWebmasterSectionTitle !!}</span>--}}
{{--                                    </a>--}}
{{--                                    <ul class="nav-sub">--}}
{{--                                        @if($GeneralWebmasterSection->sections_status > 0)--}}

{{--                                            <?php--}}
{{--                                            $currentFolder = "categories"; // Put folder name here--}}
{{--                                            $PathCurrentFolder = substr($urlAfterRoot,--}}
{{--                                                (strlen($GeneralWebmasterSection->id) + 1), strlen($currentFolder));--}}
{{--                                            ?>--}}
{{--                                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }} >--}}
{{--                                                <a href="{{ route('categories',$GeneralWebmasterSection->id) }}">--}}
{{--                                                    <span--}}
{{--                                                        class="nav-text">{{ __('backend.sectionsOf') }} {{ $GeneralWebmasterSectionTitle }}</span>--}}
{{--                                                </a>--}}
{{--                                            </li>--}}
{{--                                        @endif--}}

{{--                                        <?php--}}
{{--                                        $currentFolder = "topics"; // Put folder name here--}}
{{--                                        $PathCurrentFolder = substr($urlAfterRoot,--}}
{{--                                            (strlen($GeneralWebmasterSection->id) + 1), strlen($currentFolder));--}}
{{--                                        ?>--}}
{{--                                        <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }} >--}}
{{--                                            <a href="{{ route('topics',$GeneralWebmasterSection->id) }}">--}}
{{--                                                <span--}}
{{--                                                    class="nav-text">{!! $GeneralWebmasterSectionTitle !!}</span>--}}
{{--                                            </a>--}}
{{--                                        </li>--}}

{{--                                    </ul>--}}
{{--                                </li>--}}

{{--                            @else--}}
{{--                                <li {{ ($GeneralWebmasterSection->id== @$WebmasterSection->id) ? 'class=active' : '' }}>--}}
{{--                                    <a href="{{ route('topics',$GeneralWebmasterSection->id) }}">--}}
{{--                  <span class="nav-icon">--}}
{{--                    <i class="material-icons">{!! $LiIcon !!}</i>--}}
{{--                  </span>--}}
{{--                                        <span--}}
{{--                                            class="nav-text">{!! $GeneralWebmasterSectionTitle !!}</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            @endif--}}
{{--                        @endif--}}
{{--                    @endforeach--}}



                    @if(Helper::GeneralWebmasterSettings("banners_status"))
                        @if(@Auth::user()->permissionsGroup->banners_status)
                            <?php
                            $currentFolder = "banners"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }} >
                                <a href="{{ route('Banners') }}">
<span class="nav-icon">
<i class="material-icons">&#xe433;</i>
</span>
                                    <span class="nav-text">{{ __('backend.adsBanners') }}</span>
                                </a>
                            </li>
                        @endif
                    @endif

                    @if(Helper::GeneralWebmasterSettings("settings_status"))
                        @if(@Auth::user()->permissionsGroup->settings_status)
                            <li class="nav-header hidden-folded">
                                <small class="text-muted">{{ __('backend.settings') }}</small>
                            </li>

                            <?php
                            $currentFolder = "settings"; // Put folder name here
                            $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));

                            $currentFolder2 = "menus"; // Put folder name here
                            $PathCurrentFolder2 = substr($urlAfterRoot, 0, strlen($currentFolder2));

                            $currentFolder3 = "users"; // Put folder name here
                            $PathCurrentFolder3 = substr($urlAfterRoot, 0, strlen($currentFolder3));

                            $currentFolder4 = "file-manager"; // Put folder name here
                            $PathCurrentFolder4 = substr($urlAfterRoot, 0, strlen($currentFolder4));
                            ?>
                            <li {{ ($PathCurrentFolder==$currentFolder || $PathCurrentFolder2==$currentFolder2 || $PathCurrentFolder3==$currentFolder3 || $PathCurrentFolder4==$currentFolder4 ) ? 'class=active' : '' }}>
                                <a>
<span class="nav-caret">
<i class="fa fa-caret-down"></i>
</span>
                                    <span class="nav-icon">
<i class="material-icons">&#xe8b8;</i>
</span>
                                    <span class="nav-text">{{ __('backend.generalSiteSettings') }}</span>
                                </a>
                                <ul class="nav-sub">
                                    <?php
                                    $currentFolder = "settings"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a href="{{ route('settings') }}"
                                           onclick="location.href='{{ route('settings') }}'">
                                            <span class="nav-text">{{ __('backend.generalSettings') }}</span>
                                        </a>
                                    </li>
                                        <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                            <a href="{{ route('admin.config.index') }}"
                                               onclick="location.href='{{ route('admin.config.index') }}'">
                                                <span class="nav-text">{{ __('backend.configs') }}</span>
                                            </a>
                                        </li>
                                    <?php
                                    $currentFolder = "menus"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a href="{{ route('menus') }}">
                                            <span class="nav-text">{{ __('backend.siteMenus') }}</span>
                                        </a>
                                    </li>
                                    <?php
                                    $currentFolder = "file-manager"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a href="{{ route('FileManager') }}">
                                            <span class="nav-text">{{ __('backend.fileManager') }}</span>
                                        </a>
                                    </li>
                                    <?php
                                    $currentFolder = "users"; // Put folder name here
                                    $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                                    ?>
                                    <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                                        <a href="{{ route('users') }}">
                                            <span class="nav-text">{{ __('backend.usersPermissions') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    @endif


                    @if(@Auth::user()->permissionsGroup->webmaster_status)
                        <?php
                        $currentFolder = "webmaster"; // Put folder name here
                        $PathCurrentFolder = substr($urlAfterRoot, 0, strlen($currentFolder));
                        ?>
                        <li {{ ($PathCurrentFolder==$currentFolder) ? 'class=active' : '' }}>
                            <a>
<span class="nav-caret">
<i class="fa fa-caret-down"></i>
</span>
                                <span class="nav-icon">
<i class="material-icons">&#xe8be;</i>
</span>
                                <span class="nav-text">{{ __('backend.webmasterTools') }}</span>
                            </a>
                            <ul class="nav-sub">
                                <?php
                                $PathCurrentSubFolder = substr($urlAfterRoot, 0, (strlen($currentFolder) + 1));
                                ?>
                                <li {{ ($PathCurrentFolder==$PathCurrentSubFolder) ? 'class=active' : '' }}>
                                    <a href="{{ route('webmasterSettings') }}"
                                       onclick="location.href='{{ route('webmasterSettings') }}'">
                                        <span class="nav-text">{{ __('backend.generalSettings') }}</span>
                                    </a>
                                </li>
                                <?php
                                $currentSubFolder = "sections"; // Put folder name here
                                $PathCurrentSubFolder = substr($urlAfterRoot, (strlen($currentFolder) + 1),
                                    strlen($currentSubFolder));
                                ?>
                                <li {{ ($PathCurrentSubFolder==$currentSubFolder) ? 'class=active' : '' }}>
                                    <a href="{{ route('WebmasterSections') }}">
                                        <span class="nav-text">{{ __('backend.siteSectionsSettings') }}</span>
                                    </a>
                                </li>
                                <?php
                                $currentSubFolder = "banners"; // Put folder name here
                                $PathCurrentSubFolder = substr($urlAfterRoot, (strlen($currentFolder) + 1),
                                    strlen($currentSubFolder));
                                ?>
                                <li {{ ($PathCurrentSubFolder==$currentSubFolder) ? 'class=active' : '' }}>
                                    <a href="{{ route('WebmasterBanners') }}">
                                        <span class="nav-text">{{ __('backend.adsBannersSettings') }}</span>
                                    </a>
                                </li>

                            </ul>
                        </li>

                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>
