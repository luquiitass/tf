<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body{
            margin-left:20px;
            margin-right:20px
        }
       table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
            background-color: white;
            border-collapse: collapse;
            border-spacing: 0;
        }
        tr{
            display: table-row;
            vertical-align: inherit;
            border-color: inherit
        }
        td{
            border-top: 1px solid #f4f4f4;
            padding: 8px;
            vertical-align: top;
        }

       .encabezado{
           height:110px;
           padding: 10px 15px;
           display: -webkit-box;
           display: -ms-flexbox;
           display: flex;
           -webkit-box-pack: justify;
           -ms-flex-pack: justify;
           justify-content: space-between;
           border-bottom: 1px solid #e0e0e0;
           -webkit-box-align: center;
           -ms-flex-align: center;
           align-items: center;
       }

       .logo{
           width:110px;
           height:110px;
           margin:auto
       }

       .borde{
           border : 1px solid #e22824;
       }
       .usuario{
           text-align:right;
       }

       .datos{
           width:100%;
           align-items:right;
           text-align:right;
           display:inline-block;
           padding-right: 15px;
       }

       .hijo{
           flex: 2;
           display: flex;
           justify-content: space-between;
       }
       .descripcion{
           padding:5px;
           padding-left:30px;
           padding-right:30px;
           border-bottom: 1px solid #e0e0e0;

       }

       .titulo{
           text-align:center;
           text-align:center;
           align-items:center;
           alignment-adjust:center;
           text-justify:center
       }

       .hijo2{
           flex: 4;
           display: flex;
           display:inline-block;
           text-align:center;
       }


    </style>

</head>
<body>

    <div class="encabezado borde">
        <div class="hijo">
            <img class ="logo" src="data:image/png;base64,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" alt=" Logo" />
        </div>
        <div class="hijo2">
            <h1>Titulo</h1>
            <h3>Nombre del reporte</h3>
        </div>
        <div class="hijo ">
            <div class="datos">
                <p>29 de Febrero de 2017</p>
                <p >10:12:54</p>
            </div>
        </div>
    </div>

    <!--<div>
        <div class="datos">
            <h4>Nombre del usuario</h4>
            <h4>Role que posee</h4>
        </div>
    </div>
    -->

    <div class="descripcion">

    </div>


    <table>
        <tbody>
            <tr>
                @foreach($columns as $column)
                <th>
                    {{$column}}
                </th>
                @endforeach
            </tr>
        </tbody>
        @foreach($items as $item)
            <tr>
                @foreach($columns as $key=>$value)
                    <td>
                        {{$item[$key]}}
                    </td>
                @endforeach
            </tr>
        @endforeach
    </table>

</body>
</html>