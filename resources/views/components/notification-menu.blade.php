<div>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          @if ($unreadnotifications)
          <span class="badge badge-warning navbar-badge">{{ $unreadnotifications }}</span>
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{ $unreadnotifications . " " . 'Notifications' }}</span>
          <div class="dropdown-divider"></div>
          @if($notifications)
          @foreach ($notifications as $notification )
          <a href="{{ $notification['data']['url']}}?notification_id={{  $notification->id }}" class="dropdown-item  @if ($notification->unread()) text-bold @endif">
            <i class="fas fa-envelope mr-2"></i> {{ $notification->data['body'] }}
            <span class="float-right text-muted text-sm">{{ $notification->created_at->longAbsoluteDiffForHumans() }}</span>
          </a>


          @endforeach
          @endif
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
</div>
