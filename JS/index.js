const result_div = document.querySelector("body>section#result");
const result_paragraph = document.querySelector(
  "body>section#result>p#result2"
);
const close = document.querySelector("section>div.close");
const winner = result_paragraph.textContent;

const closing = () => {
  if (result_div.style.display === "block") {
    result_div.style.display = "none";
  }
};

const show_answer = () => {
  if (winner.trim() !== "") {
    result_div.style.display = "block";
  } else {
    result_div.style.display = "none";
  }
};
show_answer();
