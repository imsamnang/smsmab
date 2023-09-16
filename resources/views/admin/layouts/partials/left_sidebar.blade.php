<aside class="sidebar-wrapper" data-simplebar="true">
  <div class="sidebar-header">
    <div>
      <img src="{{ asset('public/assets/backend') }}/images/logo-icon.png" class="logo-icon" alt="logo icon">
    </div>
    <div>
      <h4 class="logo-text">SMS</h4>
    </div>
    <div class="toggle-icon ms-auto"><i class="bi bi-chevron-double-left"></i>
    </div>
  </div>
  <!--navigation-->
  <ul class="metismenu" id="menu">
    <li>
      <a href="{{ route('admin.dashboard') }}">
        <div class="parent-icon"><i class="fadeIn animated bx bx-home-smile"></i>
        </div>
        <div class="menu-title">{{ trans('global.dashboard') }}</div>
      </a>
    </li>
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="fadeIn animated bx bx-user"></i>
        </div>
        <div class="menu-title">{{ trans('cruds.userManagement.title') }}</div>
      </a>
      <ul>
        <li> <a href="{{ route('admin.permissions.index') }}"><i class="bi bi-arrow-right-short"></i>{{ trans('cruds.permission.title') }}</a>
        </li>
        <li> <a href="{{ route('admin.roles.index') }}"><i class="bi bi-arrow-right-short"></i>{{ trans('cruds.role.title') }}</a>
        </li>
        <li> <a href="{{ route('admin.users.index') }}"><i class="bi bi-arrow-right-short"></i>{{ trans('cruds.user.title') }}</a>
        </li>
      </ul>
    </li>
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="fadeIn animated bx bx-user-circle"></i>
        </div>
        <div class="menu-title">{{ trans('cruds.courseManagement.title') }}</div>
      </a>
      <ul>
        <li> <a href="{{route('admin.courses.manage')}}"><i class="bi bi-arrow-right-short"></i>{{ trans('cruds.course.title') }}</a>
        </li>
        <li> <a href="#"><i class="bi bi-arrow-right-short"></i>{{ trans('cruds.document.title') }}</a>
        </li>
        <li> <a href="#"><i class="bi bi-arrow-right-short"></i>{{ trans('cruds.document_life.title') }}</a>
        </li>
        <li> <a href="#"><i class="bi bi-arrow-right-short"></i>{{ trans('cruds.document_life_detail.title') }}</a>
        </li>
      </ul>
    </li>
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="fadeIn animated bx bx-shopping-bag"></i>
        </div>
        <div class="menu-title">{{ trans('cruds.studentManagement.title') }}</div>
      </a>
      <ul>
        <li>
          <a href="{{route('admin.students.register')}}"><i class="fadeIn animated bx bx-restaurant"></i>{{ trans('cruds.student.title') }}</a>
        </li>
        <li>
          <a href="#"><i class="fadeIn animated bx bx-store-alt"></i>{{ trans('cruds.room.title') }}</a>
        </li>
      </ul>
    </li>
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="fadeIn animated bx bx-shopping-bag"></i>
        </div>
        <div class="menu-title">{{ trans('cruds.feeManagement.title') }}</div>
      </a>
      <ul>
        <li>
          <a href="{{route('admin.students.getPayment')}}"><i class="fadeIn animated bx bx-restaurant"></i>{{ trans('cruds.fee.title_singular') }}</a>
        </li>
      </ul>
    </li>
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="fadeIn animated bx bx-shopping-bag"></i>
        </div>
        <div class="menu-title">{{ trans('cruds.report.title') }}</div>
      </a>
      <ul>
        <li>
          <a href="{{route('admin.students.getStudentList')}}"><i class="fadeIn animated bx bx-restaurant"></i>{{ trans('cruds.report.fields.studentlist') }}</a>
        </li>
        <li>
          <a href="{{route('admin.students.getStudentListMultiClass')}}"><i class="fadeIn animated bx bx-restaurant"></i>{{ trans('cruds.report.fields.student_multi_class') }}</a>
        </li>
      </ul>
    </li>
    <li>
      <a href="#">
        <div class="parent-icon"><i class="fadeIn animated bx bx-history"></i>
        </div>
        <div class="menu-title">{{ trans('cruds.customer_history.title') }}</div>
      </a>
    </li>
    <li>
      <a href="#">
        <div class="parent-icon"><i class="fadeIn animated bx bx-health"></i>
        </div>
        <div class="menu-title">{{ trans('cruds.lifesign.title') }}</div>
      </a>
    </li>
    <li>
      <a href="javascript:;" class="has-arrow">
        <div class="parent-icon"><i class="fadeIn animated bx bx-camera"></i>
        </div>
        <div class="menu-title">{{ trans('cruds.labo_management.title') }}</div>
      </a>
      <ul>
        <li>
          <a href="#">
            <div class="parent-icon"><i class="fadeIn animated bx bx-detail"></i>
            </div>
            <div class="menu-title">{{ trans('cruds.item_group.title') }}</div>
          </a>
        </li>
        <li>
          <a href="#">
            <div class="parent-icon"><i class="fadeIn animated bx bx-detail"></i>
            </div>
            <div class="menu-title">{{ trans('cruds.item_type.title') }}</div>
          </a>
        </li>
        <li>
          <a href="#">
            <div class="parent-icon"><i class="fadeIn animated bx bx-detail"></i>
            </div>
            <div class="menu-title">{{ trans('cruds.item.title') }}</div>
          </a>
        </li>
      </ul>
    </li>
    <li>
      <a href="#">
        <div class="parent-icon"><i class="fadeIn animated bx bx-health"></i>
        </div>
        <div class="menu-title">{{ trans('cruds.company_information.title') }}</div>
      </a>
    </li>
  </ul>
  <!--end navigation-->
</aside>
