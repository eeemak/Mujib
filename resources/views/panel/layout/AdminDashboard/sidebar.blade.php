<div class="page-sidebar">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation">
        <li class="xn-logo">
            <a href="index.html">NetaBD</a>
            <a href="#" class="x-navigation-control"></a>
        </li>
        <li class="xn-profile">
            <a href="#" class="profile-mini">
                <img ng-if="!editUserProfile.PhotoPath" src="{{ asset('img/no-image.jpg') }}"/>
                <img ng-if="editUserProfile.PhotoPath" src="@{{ editUserProfile.PhotoPath }}"/>
            </a>
            <div class="profile">
                <div class="profile-image">
                        <img ng-if="!editUserProfile.PhotoPath" src="{{ asset('img/no-image.jpg') }}"/>
                        <img ng-if="editUserProfile.PhotoPath" src="@{{ editUserProfile.PhotoPath }}"/>
                </div>
                <div class="profile-data">
                    <div class="profile-data-name">{{ Auth::user()->name }}</div>
                    <div class="profile-data-title">Web Developer/Designer</div>
                </div>
                <div class="profile-controls">
                    <a href="pages-profile.html" class="profile-control-left"><span class="fa fa-info"></span></a>
                    <a href="pages-messages.html" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                </div>
            </div>
        </li>
        <li class="xn-title">Navigation</li>
        <li class="{{ Request::is('dashboard') ? 'active':'' }}">
            <a href="{{ route('dashboard') }}"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
        </li>
        <li class="{{ Request::is('profile') ? 'active':'' }}">
            <a href="{{ route('profile') }}"><span class="fa fa-user"></span> <span class="xn-text">Profile</span></a>
        </li>
        @role('admin')
        <li class="{{ Request::is('upload') ? 'active':'' }}">
            <a href="{{ route('upload') }}"><span class="fa fa-user"></span> <span class="xn-text">Upload</span></a>
        </li>
        
        <li class="xn-openable">
            <a href="#"><span class="fa fa-files-o"></span> <span class="xn-text">Master Data</span></a>
            <ul>
                <li><a href="pages-gallery.html"><span class="fa fa-image"></span> Division</a></li>
                <li><a href="pages-profile.html"><span class="fa fa-user"></span> District</a></li>
                <li><a href="pages-address-book.html"><span class="fa fa-users"></span> Thana</a></li>
                
            </ul>
        </li>
        @endrole
        <li class="xn-openable">
            <a href="#"><span class="fa fa-file-text-o"></span> <span class="xn-text">Layouts</span></a>
            <ul>
                <li><a href="layout-boxed.html">Boxed</a></li>
                <li><a href="layout-nav-toggled.html">Navigation Toggled</a></li>
                <li><a href="layout-nav-top.html">Navigation Top</a></li>
                <li><a href="layout-nav-right.html">Navigation Right</a></li>
                <li><a href="layout-nav-top-fixed.html">Top Navigation Fixed</a></li>
                <li><a href="layout-nav-custom.html">Custom Navigation</a></li>
                <li><a href="layout-frame-left.html">Frame Left Column</a></li>
                <li><a href="layout-frame-right.html">Frame Right Column</a></li>
                <li><a href="layout-search-left.html">Search Left Side</a></li>
                <li><a href="blank.html">Blank Page</a></li>
            </ul>
        </li>
        <li class="xn-title">Components</li>
        <li class="xn-openable">
            <a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">UI Kits</span></a>
            <ul>
                <li><a href="ui-widgets.html"><span class="fa fa-heart"></span> Widgets</a></li>
                <li><a href="ui-elements.html"><span class="fa fa-cogs"></span> Elements</a></li>
                <li><a href="ui-buttons.html"><span class="fa fa-square-o"></span> Buttons</a></li>
                <li><a href="ui-panels.html"><span class="fa fa-pencil-square-o"></span> Panels</a></li>
                <li><a href="ui-icons.html"><span class="fa fa-magic"></span> Icons</a>
                    <div class="informer informer-warning">+679</div>
                </li>
                <li><a href="ui-typography.html"><span class="fa fa-pencil"></span> Typography</a></li>
                <li><a href="ui-portlet.html"><span class="fa fa-th"></span> Portlet</a></li>
                <li><a href="ui-sliders.html"><span class="fa fa-arrows-h"></span> Sliders</a></li>
                <li><a href="ui-alerts-popups.html"><span class="fa fa-warning"></span> Alerts & Popups</a></li>
                <li><a href="ui-lists.html"><span class="fa fa-list-ul"></span> Lists</a></li>
                <li><a href="ui-tour.html"><span class="fa fa-random"></span> Tour</a></li>
            </ul>
        </li>
        <li class="xn-openable">
            <a href="#"><span class="fa fa-pencil"></span> <span class="xn-text">Forms</span></a>
            <ul>
                <li>
                    <a href="form-layouts-two-column.html"><span class="fa fa-tasks"></span> Form Layouts</a>
                    <div class="informer informer-danger">New</div>
                    <ul>
                        <li><a href="form-layouts-one-column.html"><span class="fa fa-align-justify"></span> One Column</a></li>
                        <li><a href="form-layouts-two-column.html"><span class="fa fa-th-large"></span> Two Column</a></li>
                        <li><a href="form-layouts-tabbed.html"><span class="fa fa-table"></span> Tabbed</a></li>
                        <li><a href="form-layouts-separated.html"><span class="fa fa-th-list"></span> Separated Rows</a></li>
                    </ul>
                </li>
                <li class="active"><a href="form-elements.html"><span class="fa fa-file-text-o"></span> Elements</a></li>
                <li><a href="form-validation.html"><span class="fa fa-list-alt"></span> Validation</a></li>
                <li><a href="form-wizards.html"><span class="fa fa-arrow-right"></span> Wizards</a></li>
                <li><a href="form-editors.html"><span class="fa fa-text-width"></span> WYSIWYG Editors</a></li>
                <li><a href="form-file-handling.html"><span class="fa fa-floppy-o"></span> File Handling</a></li>
            </ul>
        </li>
        <li class="xn-openable">
            <a href="tables.html"><span class="fa fa-table"></span> <span class="xn-text">Tables</span></a>
            <ul>
                <li><a href="table-basic.html"><span class="fa fa-align-justify"></span> Basic</a></li>
                <li><a href="table-datatables.html"><span class="fa fa-sort-alpha-desc"></span> Data Tables</a></li>
                <li><a href="table-export.html"><span class="fa fa-download"></span> Export Tables</a></li>
            </ul>
        </li>
        <li class="xn-openable">
            <a href="#"><span class="fa fa-bar-chart-o"></span> <span class="xn-text">Charts</span></a>
            <ul>
                <li><a href="charts-morris.html"><span class="xn-text">Morris</span></a></li>
                <li><a href="charts-nvd3.html"><span class="xn-text">NVD3</span></a></li>
                <li><a href="charts-rickshaw.html"><span class="xn-text">Rickshaw</span></a></li>
                <li><a href="charts-other.html"><span class="xn-text">Other</span></a></li>
            </ul>
        </li>
        <li>
            <a href="maps.html"><span class="fa fa-map-marker"></span> <span class="xn-text">Maps</span></a>
        </li>
        <li class="xn-openable">
            <a href="#"><span class="fa fa-sitemap"></span> <span class="xn-text">Navigation Levels</span></a>
            <ul>
                <li class="xn-openable">
                    <a href="#">Second Level</a>
                    <ul>
                        <li class="xn-openable">
                            <a href="#">Third Level</a>
                            <ul>
                                <li class="xn-openable">
                                    <a href="#">Fourth Level</a>
                                    <ul>
                                        <li><a href="#">Fifth Level</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
    <!-- END X-NAVIGATION -->
</div>