
(function () {
    var width = window.innerWidth;
    var flag = false;
    flag = check_width(flag);
    window.addEventListener('resize', function () {
       if (window.innerWidth !== width) {
         flag = check_width(flag);
       }
    });
})();

function check_width(flag){
  if($(window).width() <= 558){
    if(flag == false){
      document.getElementById("accordionSidebar").classList.add("sidebar-absolute");
      document.getElementById("accordionSidebar").style.position = "absolute";
      document.getElementById("accordionSidebar").style.zIndex = "1000";
      document.getElementById("accordionSidebar").style.width = "30%";
      document.getElementById("accordionSidebar").style.height = "auto";
      document.getElementById("accordionSidebar").style.borderBottomRightRadius = "13px";
      flag = true;
    }
  }else{
    if(flag == true){
      document.getElementById("accordionSidebar").classList.remove("sidebar-absolute");
      document.getElementById("accordionSidebar").style.position = "";
      document.getElementById("accordionSidebar").style.zIndex = "";
      document.getElementById("accordionSidebar").style.width = "";
      document.getElementById("accordionSidebar").style.height = "";
      document.getElementById("sidebarToggleTop").style.marginLeft = "";
      document.getElementById("accordionSidebar").style.borderBottomRightRadius = "0";

      flag = false;
    }
  }
  return flag;
}
