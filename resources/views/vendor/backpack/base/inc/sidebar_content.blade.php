{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('category') }}"><i class="nav-icon la la-question"></i> Categories</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('company') }}"><i class="nav-icon la la-question"></i> Companies</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('arrears-item') }}"><i class="nav-icon la la-question"></i> Arrears items</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('arrears-master') }}"><i class="nav-icon la la-question"></i> Arrears masters</a></li>