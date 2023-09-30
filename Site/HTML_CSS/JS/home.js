document.addEventListener('DOMContentLoaded', function () {
    const productContainers = [...document.querySelectorAll('.product-container')];
    const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
    const preBtn = [...document.querySelectorAll('.pre-btn')];

    productContainers.forEach((item, i) => {
        let containerDimenstions = item.getBoundingClientRect();
        let containerWidth = containerDimenstions.width;

        nxtBtn[i].addEventListener('click', () => {
            item.scrollLeft += containerWidth;
        });

        preBtn[i].addEventListener('click', () => {
            item.scrollLeft -= containerWidth;
        });
    });

    const arrowHoverEffect = (arrow) => {
        arrow.addEventListener('mouseover', () => {
            arrow.style.transform = 'translateY(-60%) translateX(5px)';
        });
    
        arrow.addEventListener('mouseout', () => {
            arrow.style.transform = 'translateY(-60%)';
        });
    };

    nxtBtn.forEach((arrow) => {
        arrowHoverEffect(arrow);
    });

    preBtn.forEach((arrow) => {
        arrowHoverEffect(arrow);

    });
});
