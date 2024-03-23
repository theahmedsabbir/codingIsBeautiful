<div class="right-sidebar">
    <div class="widget widget-jobs">
        <div class="sd-title">
            <h3>{{ $title ?? 'Active discussions' }}</h3>
        </div>
        <div class="jobs-list">

            @if (isset($sidebarPosts) && count($sidebarPosts) > 0)
                @foreach ($sidebarPosts as $sidebarPost)
                    <div class="job-info">
                        <div class="job-details">
                            <h3><a href="{{ url('article', $sidebarPost->slug) }}">{{ $sidebarPost->title }}</a></h3>
                            <p>{{ $sidebarPost->totalViews() }} Views</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div><!--jobs-list end-->
    </div>
</div><!--right-sidebar end-->
