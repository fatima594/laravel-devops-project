<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('admin/dist/img/fatimablog.jpg')}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Fatima Lakhal</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">

                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.post.index') }}"><i class="fa fa-edit"></i> Manage Posts</a></li>
                </ul>


                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.category.index') }}"><i class="fa fa-tags"></i> Manage Categories</a></li>
                </ul>
                  <ul class="treeview-menu">
                    <li><a href="{{ route('admin.about.index') }}"><i class="fa fa-tags"></i> Manage About Us</a></li>
                </ul>


                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.admin.comment') }}"><i class="fa fa-comment"></i> See Your Comments</a></li>
                </ul>

           <ul class="treeview-menu">
                    <li><a href="{{ route('admin.admin.contacts') }}"><i class="fa fa-envelope"></i> See Your Contacts</a></li>
                </ul>

                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.social-media.index') }}"><i class="fa fa-users"></i> See Your social-media</a></li>
                </ul>
               <ul class="treeview-menu">
                    <li><a href="{{ route('admin.subscribers') }}"><i class="fa fa-users"></i> See Your Subscribers</a></li>
                </ul>


            </li>


    </section>
    <!-- /.sidebar -->
</aside>

