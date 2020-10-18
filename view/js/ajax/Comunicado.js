$(function () {
    var folder = "comunicado";
    var invisible = [0];
    
    $("#btnProcurarComunicado").click(function () {
        var $this = $("#btnProcurarMensagem");
        $this.button('loading');
        procurar(folder, invisible, $this);
    });
});