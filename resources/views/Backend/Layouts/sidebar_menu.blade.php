@php

$prefix= Request:: route()->getPrefix();
$route= Route:: current()->getName();
  
@endphp


{{-- Sidebar menu starts here --}}
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

<!-- Manage user -->
        @if(Auth::user()->user_type=='Admin')
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
          <li class="nav-item has-treeview {{($prefix=='/colors')?'m