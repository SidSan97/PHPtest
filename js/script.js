function fecharNotificacao()
{
    document.getElementById("notification").style.display = "none";
}

function fecharNotificacao2()
{
    document.getElementById("notification2").style.display = "none";
}

$('#cep').blur(function()
{
    var cep = $('#cep').val();

    if(cep.length < 9 && cep != '')
    {
        alert('CEP inválido: ' + cep);
        $('#cep').val('');
        document.getElementById("cep").style.borderColor  = "#f00";
        document.getElementById("btnPesquisa").style.borderColor  = "#f00";
    }
});
