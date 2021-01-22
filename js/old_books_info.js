const resultContainer=document.querySelector(".result-container");
const resultContent=document.querySelector(".result-content");

function displayContainer(addClass,content)
{
    resultContainer.classList.add(addClass);
    resultContent.innerHTML=content;
    setTimeout(() => {
        resultContainer.classList.remove(addClass);
        resultContainer.style.display="none";
    }, 3000);
}
