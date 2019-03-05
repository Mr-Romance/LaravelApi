@if(count($topics))

    <ul class="list-unstyled">
        @foreach($topics as $topic)
            <li class="media">
                <div class="head_portrait">
                    <img class="img-thumbnail" style="width:100px;height:100px" src="{{$topic->user->head_portrait}}">
                </div>
                <div class="media-body">
                    <h5 class="mt-0 mb-1">{{$topic->title}}</h5>
                    <p>{{$topic->body}}</p>
                    <p>
                        <a href="{{route('category-topics-list',['category_id'=>$topic->category->id])}}">
                        {{$topic->category->name}}
                        </a>
                        <span>.</span>
                        {{$topic->user->name}}
                        <span>.</span>
                        {{$topic->created_at}}
                    </p>
                </div>
            </li>
        @endforeach
    </ul>
    {{$topics->links()}}
@else
    <div><h4>暂无数据</h4></div>
@endIf