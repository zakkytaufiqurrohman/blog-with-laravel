<div class="widget categories">
    <header>
        <h3 class="h6">Categories</h3>
    </header>
    <?php foreach (\App\Category::all() as $key ): ?>
    	<div class="item d-flex justify-content-between"><a href="{{ url('/blog/category/'.$key->slug) }}">{{$key->title}}</a><span>{{$key->post->count()}}</span></div>
    <?php endforeach ?>
    
    
</div>