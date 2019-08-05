<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="row">
    <div class="col-sm-6">
        <table style="border: 1px solid black">
            @foreach($projects as $p)
                <tr>
                    <td>Name: {{$p->name}}</td>
                    <td>Description: {{$p->description}}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
<div class="flex-center position-ref full-height">

    <div id="app">
        <form method="POST" action="{{route('project-save')}}" @submit.prevent="onSubmit()" @keydown="form.errors.clear($event.target.name)">
            @csrf
            <div class="form-group">
                <label for="name">Project name:</label>
                <input type="name" name="name" class="form-control" id="name" v-model="form.name">
                <br><span v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
            </div>
            <div class="form-group">
                <label for="description">Project description:</label>
                <input type="text" name="description" class="form-control" id="description" v-model="form.description">
                <br><span v-if="form.errors.has('description')" v-text="form.errors.get('description')"></span>
            </div>

            <button type="submit" :disabled="form.errors.any()" class="btn btn-default">Submit</button>


        </form>
    </div>
</div>
<script src="https://vuejs.org/js/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.js"></script>
<script src="/js/projects.js"></script>

</body>
</html>
