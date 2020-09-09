<html lang='pt-br'>
<head>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>Perfect Pay - Teste Ronan - @yield('title')</title>
    <link href="{{ asset('/images/brand/favicon.png') }}" rel="icon" type="image/png"/>
    <link rel='stylesheet' href="{{ url('/css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        .wrapper #wrapperContent, .wrapper #wrapperContent.closed {
            padding: 0;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/jquery.dataTables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/jquery-ui.css') }}"/>
</head>
<body>
<!-- NAVBAR TOP -->
@include('layout_header')
<div class='wrapper'>
    <div id='wrapperContent' class='content container-fluid'>
        <div id='main'>
            @yield('content')
        </div>
    </div>
</div>
<script src="{{ url('/js/app.js') }}"></script>
<script src="https://kit.fontawesome.com/d712964458.js" crossorigin="anonymous"></script>
@yield('script')
<script type="text/javascript" charset="utf8" src="{{ url('/js/jquery.dataTables.js') }}"></script>
<script src="{{ url('/js/jquery.mask.js') }}" type="text/javascript"></script>
<script src="{{ url('/js/script-mask.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready( function () {
            $('#indexTable').DataTable({
                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                "language": {
                    "aria": {
                        "sortAscending": ": ativar para classificar coluna ascendente",
                        "sortDescending": ": ativar para classificar coluna descendente"
                    },
                    "emptyTable": "Nenhum registro encontrado",
                    "info": "Exibindo _START_ até _END_ de _TOTAL_ registros",
                    "infoEmpty": "Sem registro",
                    "infoFiltered": "(filtered1 from _MAX_ total records)",
                    "lengthMenu": "Exibir _MENU_",
                    "search": "Pesquisar:",
                    "zeroRecords": "Nenhum registro encontrado",
                    "paginate": {
                        "previous":"Anterior",
                        "next": "Próximo",
                        "last": "Final",
                        "first": "Início"
                    }
                },
                // set the initial value
                "pageLength": 10,
                "order": [
                    [0, "desc"]
                ] // set first column as a default sort by asc
            });

            $('#dashboardTable').DataTable({
                // Internationalisation. For more info refer to http://datatables.net/manual/i18n
                "language": {
                    "aria": {
                        "sortAscending": ": ativar para classificar coluna ascendente",
                        "sortDescending": ": ativar para classificar coluna descendente"
                    },
                    "emptyTable": "Nenhum registro encontrado",
                    "info": "Exibindo _START_ até _END_ de _TOTAL_ registros",
                    "infoEmpty": "Sem registro",
                    "infoFiltered": "(filtered1 from _MAX_ total records)",
                    "lengthMenu": "Exibir _MENU_",
                    "search": "Pesquisar:",
                    "zeroRecords": "Nenhum registro encontrado",
                    "paginate": {
                        "previous":"Anterior",
                        "next": "Próximo",
                        "last": "Final",
                        "first": "Início"
                    }
                },
                "lengthMenu": [
                    [5, 10, 50, 100, -1],
                    [5, 10, 50, 100, "Todos"] // change per page values here
                ],
                // set the initial value
                "pageLength": 5,
                "order": [
                    [1, "desc"]
                ] // set first column as a default sort by asc
            });

            src = "{{ route('searchClient') }}";
            $("#name").autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: src,
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function (data) {
                            response(data);

                        }
                    });
                },
                select: function (event, ui) {
                    // prevent autocomplete from updating the textbox
                    event.preventDefault();

                    if(ui.item.id) {
                        $("#client_id").val(ui.item.id);
                        $("#name").val(ui.item.value);
                        $("#email").val(ui.item.email);
                        $("#cpf").val(ui.item.cpf);
                    }


                },
                minLength: 3,

            });

        });
    </script>
</body>
</html>
