document.addEventListener("DOMContentLoaded", function () {
  const textarea1 = document.getElementById("InputMessageRegistration");
  const textarea2 = document.getElementById("InputMessageOrder");
  const textarea3 = document.getElementById("InputMessageCreateReview");
  textarea1.style.height = "100px";
  textarea2.style.height = "100px";
  textarea3.style.height = "100px";
});

document
  .getElementById("InputMessageRegistration")
  .addEventListener("input", function () {
    this.style.height = "auto";
    this.style.height = Math.max(this.scrollHeight, 100) + "px";
  });

document
  .getElementById("InputMessageOrder")
  .addEventListener("input", function () {
    this.style.height = "auto";
    this.style.height = Math.max(this.scrollHeight, 100) + "px";
  });

document
  .getElementById("InputMessageCreateReview")
  .addEventListener("input", function () {
    this.style.height = "auto";
    this.style.height = Math.max(this.scrollHeight, 100) + "px";
  });
