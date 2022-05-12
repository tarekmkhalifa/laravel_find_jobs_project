// flash message pop
document.addEventListener("DOMContentLoaded", function () {
    setTimeout(() => {
        document.querySelector(".flash-message").style.cssText =
            "display: none;";
    }, 2500);
});


/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function showDrop() {
    document.getElementById("myDropdown").classList.toggle("show");
  }


  // Close the dropdown menu if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }

function showDiv() {
    var x = document.getElementById("passwordsDiv");
    if (x.style.display == "block") {
      x.style.display = "none";
    } else {
      x.style.display = "block";
    }
  }


