@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @if(Auth::user()->id != 2 AND Auth::user()->id != 1)
                <div class="alert alert-warning" role="alert">
                    你来晚了一步，被队友抢先注册了，去向队友拿 <b>{{\App\User::find(2)->name}}</b> 用户的密码吧
                </div>
            @endif

            <div class="card">
                <div class="card-header">参赛用户列表</div>

                <div class="card-body">
                   @if(Auth::user()->id == 1)
                        <div class="container">
                            <h2>来换个头像吧</h2>
                            <hr>
                            <div class="row">
                                <div class="col col-md-3">
                                    <img src="{{Auth::user()->avatar}}" width="100" style="border-radius:50%">
                                </div>
                                <div class="col col-md-6">
                                    <form class="form-horizontal" method="POST" action="/upload" enctype="multipart/form-data">
                                        @csrf
                                        <input id="file" type="file" onchange="check(this.value)" class="form-control" name="source" required>
                                        <button type="submit" class="btn btn-primary mt-5">确定</button>
                                    </form>
                                </div>
                            </div>


                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">参赛选手通知</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="pusher">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">朕知道了</button>
            </div>
        </div>
    </div>
</div>


<script src="https://js.pusher.com/4.4/pusher.min.js"></script>
<script src="/pusher-sdk/pusher.js"></script>
<script>
    var channel = pusher.subscribe('user.{{Auth::user()->id}}');
    channel.bind('my-event', function(data) {
        $('#pusher').html(data.message);
        $('#myModal').modal();
    });
    function check(filename){
        var flag = false; //状态
        var arr = ["jpg","png","gif"];
        //取出上传文件的扩展名
        var index = filename.lastIndexOf(".");
        var ext = filename.substr(index+1);
        //循环比较
        for(var i=0;i<arr.length;i++)
        {
            if(ext == arr[i])
            {
                flag = true; //一旦找到合适的，立即退出循环
                break;
            }
        }
        //条件判断
        if(flag)
        {

        }else
        {

            $("#file").val('');
        }
    }
</script>
@endsection
