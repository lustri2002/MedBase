//console.log($(".remove_button"));



function RemoveAjax(){
    $.ajax({
        url: '../functions/RimuoviReparti.php',
        type: 'POST',
        data: {
            nome: $(this).parent("td:nth-child(0)").text()
        },
        cache: true,
        success: (_) => {
            $(this).parent("tr").remove();
        }
    });
}
