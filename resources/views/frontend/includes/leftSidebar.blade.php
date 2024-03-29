<!-- categories -->
<div class="main-left-sidebar no-margin">
    <div class="suggestions full-width bg-transparent categories_body">
        <div class="suggestions-list">

            {{-- home --}}
            <div class="suggestion-usd">
                <div class="sgt-text">
                    <a href="{{ url('/') }}" class="category_link">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <span class="ml-1">Home</span>
                    </a>
                </div>
            </div>

            @foreach (App\Models\Category::orderBy('priority', 'asc')->get() as $key => $category)
                <div class="suggestion-usd">
                    <div class="sgt-text">
                        <a href="{{ url('category/' . $category->slug) }}" class="category_link"
                            style="{{ isset($selectedCateogry) && $selectedCateogry->id === $category->id ? 'font-weight: 700' : '' }}">
                            {!! $category->icon !!}
                            <span class="ml-1">{{ $category->name }}</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div><!--suggestions-list end-->
    </div><!--suggestions end-->
</div>

<!-- tags -->
<div class="main-left-sidebar no-margin tags">
    <h6 class="category_label">Tags</h6>
    <div class="suggestions full-width bg-transparent categories_body scrollable ">
        <div class="suggestions-list">

            @foreach (App\Models\Tag::orderBy('priority', 'asc')->get() as $key => $tag)
                <div class="suggestion-usd">
                    <div class="sgt-text">
                        <a href="{{ url('tag/' . $tag->slug) }}" class="category_link"
                            style="{{ isset($selectedTag) && $selectedTag->id === $tag->id ? 'font-weight: 700' : '' }}">
                            #
                            <span class="ml-1">{{ $tag->name }}</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div><!--suggestions-list end-->
    </div><!--suggestions end-->
</div>

<!-- other pages -->
<div class="main-left-sidebar no-margin">
    <h6 class="category_label">Other</h6>
    <div class="suggestions full-width bg-transparent categories_body">
        <div class="suggestions-list">
            <div class="suggestion-usd">
                <div class="sgt-text">
                    <a href="" class="category_link">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span class="ml-1">About</span>
                    </a>
                </div>
            </div>
            <div class="suggestion-usd">
                <div class="sgt-text">
                    <a href="" class="category_link">
                        <i class="fa fa-phone-square" aria-hidden="true"></i>
                        <span class="ml-1">Contact</span>
                    </a>
                </div>
            </div>
            <div class="suggestion-usd category_link_socials_list_parent">
                <div class="sgt-text category_link_socials_list">
                    <a href="" class="category_link_socials">
                        <i class="fa fa-facebook-square" aria-hidden="true"></i>
                    </a>
                    <a href="" class="category_link_socials">
                        <i class="fa fa-twitter-square" aria-hidden="true"></i>
                    </a>
                    <a href="" class="category_link_socials">
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                    </a>
                    <a href="" class="category_link_socials">
                        <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                    </a>
                    <a href="" class="category_link_socials">
                        <i class="fa fa-youtube-play" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div><!--suggestions-list end-->
    </div><!--suggestions end-->
</div>
