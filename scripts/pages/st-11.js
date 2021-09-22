$(function() {
    // ***refactor 
    els = document.getElementsByTagName('p');
    for (let i = 0; i < els.length; i++) {
        if (els[i].innerHTML.includes('[apply-formatting]')) {
            console.log(els[i]);
            el1 = els[i].parentElement;
            els[i].parentElement.removeChild(els[i]);
            const para1 = document.createElement("p");
            const node1 = document.createTextNode("Sections – stainless steel.");
            para1.appendChild(node1);
            const para2 = document.createElement("p");
            const node2 = document.createTextNode("Filler panel (for gate posts) – 8 mm tempered glass.");
            para2.appendChild(node2);
            const para3 = document.createElement("p");
            const node3 = document.createTextNode("Swing panels – 10 mm tempered glass.");
            para3.appendChild(node3);
            const para4 = document.createElement("p");
            const node4 = document.createTextNode("Top covers – Artificial quartz stone or stainless steel.");
            para4.appendChild(node4);

            const element = document.querySelector(".color_block");
            element.appendChild(para1);
            element.appendChild(para2);
            element.appendChild(para3);
            element.appendChild(para4);

        }
    }
});