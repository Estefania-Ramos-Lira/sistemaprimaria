
document.oncontextmenu = function(){return false;}

document.addEventListener('DOMContentLoaded', function() {
    var menuItems = document.querySelectorAll('#kt_aside_menu .kt-menu__item:not(#mreportes)');
    var submenuReportes = document.getElementById('submenu-reportes');

    menuItems.forEach(function(item) {
        item.addEventListener('click', function() {
            if (submenuReportes.classList.contains('kt-menu__submenu--shown')) {
                submenuReportes.classList.remove('kt-menu__submenu--shown');
            }
        });
    });
});


document.addEventListener('DOMContentLoaded', function() {
    var menuItems = document.querySelectorAll('#kt_aside_menu .kt-menu__item');

    menuItems.forEach(function(item) {
        item.addEventListener('click', function() {
            var submenuItems = document.querySelectorAll('#kt_aside_menu .kt-menu__item[data-submenu="true"]');

            submenuItems.forEach(function(submenuItem) {
                submenuItem.classList.remove('kt-menu__item--open');
                var submenu = submenuItem.querySelector('.kt-menu__submenu');
                if (submenu) {
                    submenu.style.display = 'none';
                }
            });
        });
    });
});


document.addEventListener('DOMContentLoaded', function() {
    var menuItems = document.querySelectorAll('#kt_aside_menu .kt-menu__item:not(#mreportes)');
  
    menuItems.forEach(function(item) {
      item.addEventListener('click', function() {
        closeReportesMenu();
      });
    });
  });