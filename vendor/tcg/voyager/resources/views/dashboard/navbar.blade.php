<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<nav class="navbar navbar-default navbar-fixed-top navbar-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button class="hamburger btn-link">
                <span class="hamburger-inner"></span>
            </button>
        </div>

        <ul class="nav navbar-nav navbar-right">
            {{-- Notifications --}}
            <li class="dropdown" style="position:relative;">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="voyager-bell"></i>
                    @php $unreadCount = auth()->user()->unreadNotifications->count(); @endphp
                    @if($unreadCount)
                        <span class="badge badge-primary" id="notification-count">{{ $unreadCount }}</span>
                    @endif
                </a>
                <ul class="dropdown-menu notifications dropdown-menu-animated" style="min-width:320px; max-height:350px; overflow-y:auto; padding:5px;">
                    @forelse(auth()->user()->notifications as $notification)
                        <li style="margin-bottom:5px;">
                            <a href="{{ $notification->data['url'] ?? '#' }}"
                               class="notification-link"
                               data-id="{{ $notification->id }}"
                               data-is-read="{{ $notification->read_at ? 'true' : 'false' }}"
                               style="display:block; padding:10px; border-radius:6px; transition: all 0.3s ease;
                                      background-color: {{ $notification->read_at ? '#fff' : '#22a7f0' }};
                                      color: {{ $notification->read_at ? '#333' : '#fff' }};">
                                <strong style="display:block; font-size:0.95rem;">{{ $notification->data['title'] ?? 'Мэдэгдэл' }}</strong>
                                <p style="margin:2px 0 0; font-size:12px; line-height:1.3;">{{ $notification->data['message'] ?? '' }}</p>
                                <small style="font-size:10px; opacity:0.7; display:block;">{{ $notification->created_at->diffForHumans() }}</small>
                            </a>
                        </li>
                    @empty
                        <li class="text-center text-muted" style="padding:10px;">Мэдэгдэл алга</li>
                    @endforelse
                    <li class="text-center" style="padding:5px; border-top:1px solid #eee;">
                        <a href="{{ route('voyager.notifications.index') }}">Бүгдийг харах</a>
                    </li>
                </ul>
            </li>

            {{-- Profile --}}
            <li class="dropdown profile">
                <a href="#" class="dropdown-toggle text-right" data-toggle="dropdown">
                    <img src="{{ $user_avatar }}" class="profile-img"> <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-animated">
                    <li class="profile-img text-center">
                        <img src="{{ $user_avatar }}" class="profile-img" style="width:60px; height:60px; border-radius:50%;">
                        <div class="profile-body">
                            <h5>{{ Auth::user()->name }}</h5>
                            <h6>{{ Auth::user()->email }}</h6>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <?php $nav_items = config('voyager.dashboard.navbar_items'); ?>
                    @if(is_array($nav_items) && !empty($nav_items))
                        @foreach($nav_items as $name => $item)
                            <li {!! isset($item['classes']) ? 'class="'.$item['classes'].'"' : '' !!}>
                                @if(isset($item['route']) && $item['route']=='voyager.logout')
                                    <form action="{{ route('voyager.logout') }}" method="POST" style="margin:0;">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-block btn-danger">
                                            @if(!empty($item['icon_class'])) <i class="{{ $item['icon_class'] }}"></i> @endif
                                            {{__($name)}}
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ isset($item['route']) && Route::has($item['route']) ? route($item['route']) : '#' }}">
                                        @if(!empty($item['icon_class'])) <i class="{{ $item['icon_class'] }}"></i> @endif
                                        {{__($name)}}
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    @endif
                </ul>
            </li>
        </ul>
    </div>
</nav>

<style>
.notifications .notification-link:hover {
    background-color: #286090 !important;
    color: #fff !important;
}
.badge-primary {
    background-color: #337ab7;
    font-size: 0.75em;
    transition: all 0.3s ease;
}
/* Unшсан notification hover эффект */
.notification-link[data-is-read="true"]:hover {
    background-color: #f5f5f5 !important;
    color: #333 !important;
}
</style>

<script>
$(document).ready(function(){
    $('.notification-link').click(function(e){
        e.preventDefault();

        let $link = $(this);
        let url = $link.attr('href');
        let notificationId = $link.data('id');
        let isRead = $link.data('is-read') === 'true' || $link.data('is-read') === true;

        // Хэрэв аль хэдийн уншсан бол шууд link руу очих
        if(isRead) {
            window.location.href = url;
            return;
        }

        // Уншаагүй бол AJAX илгээж unш гэж тэмдэглэх
        if(notificationId){
            $.ajax({
                url: '/admin/notifications/read',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: notificationId
                },
                success: function(response){
                    console.log('✅ Notification marked as read:', response);

                    // 1. Notification-ий өнгийг цагаан болгох
                    $link.css({
                        'background-color': '#fff',
                        'color': '#333'
                    }).data('is-read', 'true');

                    // 2. Badge тоог багасгах
                    updateBadgeCount(response.unread_count);

                    // 3. Link руу шилжих (300ms саатуулж харагдуулах)
                    setTimeout(function(){
                        window.location.href = url;
                    }, 300);
                },
                error: function(xhr, status, error){
                    console.error('❌ Error marking notification:', error);
                    console.log('Response:', xhr.responseText);

                    // Алдаа гарсан ч link руу шилжих
                    window.location.href = url;
                }
            });
        } else {
            // ID байхгүй бол шууд очих
            window.location.href = url;
        }
    });

    // Badge тоо шинэчлэх function
    function updateBadgeCount(count) {
        let $badge = $('#notification-count');

        if(count > 0) {
            if($badge.length) {
                // Badge байвал тоог солих
                $badge.text(count);
            } else {
                // Badge байхгүй бол үүсгэх
                $('.voyager-bell').after('<span class="badge badge-primary" id="notification-count">' + count + '</span>');
            }
        } else {
            // Тоо 0 болвол badge-г fade out хийж устгах
            $badge.fadeOut(300, function(){
                $(this).remove();
            });
        }
    }
});
</script>
