document.addEventListener("DOMContentLoaded", function() {
    const triangles = document.querySelectorAll(".triangle");
    const contentBlocks = document.querySelectorAll(".row-content");
  
    triangles.forEach((triangle, index) => {
      triangle.addEventListener("click", () => {
        if (contentBlocks[index].style.maxHeight) {
            contentBlocks[index].style.maxHeight = null;
            triangle.style.transform = "rotate(0deg)";
          } else {
            contentBlocks[index].style.maxHeight = contentBlocks[index].scrollHeight + "px";
            triangle.style.transform = "rotate(180deg)";
          }
      });
    });
  });