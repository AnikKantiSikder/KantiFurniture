@php

$prefix= Request:: route()->getPrefix();
$route= Route:: current()->getName();
  
@endphp


{{-- Sidebar menu starts here --}}
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

<!-- Manage user -->
        @if(Auth::user()->role=='admin')
          <li class="nav-item has-treeview {{($prefix=='/users')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage user
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('users.view') }}" class="nav-link {{($route=='users.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View user</p>
                </a>
                
              </li>
            </ul>
          </li>
        @endif
<!-- Manage profile -->
          <li class="nav-item has-treeview {{($prefix=='/profiles')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage profile
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('profiles.view') }}" class="nav-link {{($route=='profiles.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View profile</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('profiles.password.change') }}" class="nav-link {{($route=='profiles.password.change')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change password</p>
                </a>
              </li>
            </ul>
          </li>
<!-- Layout logos -->

          <li class="nav-item has-treeview {{($prefix=='/logos')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage logo
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('logos.view') }}" class="nav-link {{($route=='logos.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View logo</p>
                </a>
                
              </li>
            </ul>
          </li>

<!--Slider-->
          <li class="nav-item has-treeview {{($prefix=='/sliders')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage slider
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('sliders.view') }}" class="nav-link {{($route=='sliders.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View slider</p>
                </a>
                
              </li>
            </ul>
          </li>




<!--Contact-->
          <li class="nav-item has-treeview {{($prefix=='/contacts')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage contact
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('contacts.view') }}" class="nav-link {{($route=='contacts.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View contact</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('contacts.communicate') }}"
                class="nav-link {{($route=='contacts.communicate')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Communicate user</p>
                </a>
              </li>
            </ul>
          </li>


<!--About us-->
          <li class="nav-item has-treeview {{($prefix=='/abouts')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage abouts
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('abouts.view') }}" class="nav-link {{($route=='abouts.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View abouts</p>
                </a>
                
              </li>
            </ul>
          </li>


<!--Manage category-->
          <li class="nav-item has-treeview {{($prefix=='/categories')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage category
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('categories.view') }}" class="nav-link {{($route=='categories.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View category</p>
                </a>
                
              </li>
            </ul>
          </li>


<!--Manage brand-->
          <li class="nav-item has-treeview {{($prefix=='/brands')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage brand
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('brands.view') }}" class="nav-link {{($route=='brands.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View brand</p>
                </a>
                
              </li>
            </ul>
          </li>


<!--Manage color-->
          <li class="nav-item has-treeview {{($prefix=='/colors')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage color
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('colors.view') }}" class="nav-link {{($route=='colors.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View color</p>
                </a>
                
              </li>
            </ul>
          </li>


<!--Manage size-->
          <li class="nav-item has-treeview {{($prefix=='/sizes')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage size
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('sizes.view') }}" class="nav-link {{($route=='sizes.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View size</p>
                </a>
                
              </li>
            </ul>
          </li>


<!--Manage product-->
          <li class="nav-item has-treeview {{($prefix=='/products')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage product
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('products.view') }}" class="nav-link {{($route=='products.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View product</p>
                </a>
              </li>
            </ul>
          </li>

<!--Manage customer-->
          <li class="nav-item has-treeview {{($prefix=='/customers')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage customer
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('customers.view') }}" class="nav-link {{($route=='customers.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View customer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('customers.draft.view') }}" class="nav-link {{($route=='customers.draft.view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Draft customer</p>
                </a>
              </li>
              <li class="nav-item"> <br><br> </li>

            </ul>
          </li>

<!--Manage order-->
          <li class="nav-item has-treeview {{($prefix=='/orders')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage orders
                <i class="fas fa-angle-left right"></i>
                {{-- <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('orders.pending.list') }}" class="nav-link {{($route=='orders.pending.list')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending orders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('orders.approved.list') }}" class="nav-link {{($route=='orders.approved.list')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approved orders</p>
                </a>
              </li>
              <li class="nav-item"> <br><br><br><br></li>

            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
{{-- Sidebarmenu ends here --}}