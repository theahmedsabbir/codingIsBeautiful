<!-- categories **show conditionally** -->
<li class="nav_label">
    <h6 class="">Categories</h6>
</li>

{{-- categories --}}
@foreach (App\Models\Category::orderBy('priority', 'asc')->get() as $key => $category)
    <li class="">
        <a href="{{ url('category/' . $category->slug) }}"
            style="{{ isset($selectedCateogry) && $selectedCateogry->id === $category->id ? 'font-weight: 700' : '' }}"
            title="">{{ $category->name }}</a>
    </li>
@endforeach

<!-- others **show conditionally** -->
<li class="nav_label">
    <h6 class="">Others</h6>
</li>
<li class=""><a href="{{ url('/about') }}" title="">About</a></li>
<li class=""><a href="{{ url('/contact') }}" title="">Contact</a></li>
<li class="">
    <div class="category_link_socials_list">
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
</li>
