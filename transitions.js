document.addEventListener("DOMContentLoaded", function() {
    const triangles = document.querySelectorAll(".triangle");
  
    triangles.forEach((triangle) => {
      const rowContent = triangle.closest(".row").querySelector(".row-content");
      let isAnimating = false;
    
      //this is the code for the triangle animation. The FAQs section is set up so that if you click on a triangle, it rotates as the menu expands
      triangle.addEventListener("click", function() {
        if (!isAnimating) {
          triangle.style.animation = "rotateTriangle 0.5s linear forwards";
          rowContent.style.maxHeight = rowContent.scrollHeight + "px";
        } else {
          triangle.style.animation = "none";
          rowContent.style.maxHeight = null;
        }
        isAnimating = !isAnimating;
      });
    });
  });
  
  
  
  
  
  