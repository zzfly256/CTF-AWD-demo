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
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">用户名</th>
                                <th scope="col">密码</th>
                                <th scope="col">管理</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            <tr>
                                <th>{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <button class="btn btn-dark" onclick="{{$user->infoBtnAction}}">宣言</button>
                                    <button class="btn btn-primary" onclick="{{$user->editBtnAction}}">编辑</button>
                                    <button class="btn btn-danger" onclick="{{$user->deleteBtnAction}}">删除</button>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
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
</script>
@endsection
