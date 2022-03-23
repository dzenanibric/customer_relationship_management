function showDiv(category, num, button) {
  const targetDiv = document.getElementById(category);
  const btn = document.getElementById(button);

    if (targetDiv.style.display !== "none") {
      targetDiv.style.display = "none";
      btn.value = "Category " + num;
    } else {
      targetDiv.style.display = "block";
      btn.value = "Close Category " + num;
    }
};