// Quando o usuário rola a página
$(window).scroll(function() {
    // Obtém a posição da página atual
    var position = $(this).scrollTop();
    // Obtém a altura total da página
    var totalHeight = $(document).height() - $(window).height();
    // Calcula a porcentagem da página que já foi percorrida
    var percent = position / totalHeight * 100;
    
    // Adiciona ou remove classes CSS da barra de rolagem, dependendo da posição da página
    if (percent > 50) {
      $('.scrollbar').addClass('scrolled-halfway');
    } else {
      $('.scrollbar').removeClass('scrolled-halfway');
    }
  });
  