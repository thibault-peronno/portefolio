<section class="flex flex-col sm:flex-row">
    <img src="/assets/images/face_co.jpg" alt="" class="w-52 h-52 rounded-full self-center sm:mr-2.5 sm:self-left" />
    <div class="flex flex-col">
        <h1 class="text-3xl text-secondary bg-primary text-secondary uppercase font-bold p-2.5 sm:w-[60%] mb-5 sm:mt-12">
            Thibault PERONNO
        </h1>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt
            blanditiis modi dolores reprehenderit tenetur repudiandae quaerat
            officia ad! Earum minima cumque veritatis repudiandae eaque, doloribus
            blanditiis dolor quibusdam autem hic.
        </p>
    </div>
</section>
<section>
    <h2 class="text-2xl text-secondary uppercase font-bold my-10 sm:w-6/12 sm:mt-12">
        Mes projets
    </h2>
    <!-- For scroll works, you need add flex and shrink=0. Shrink allow to keep the width like we ask. the class to use scroll with tailwind 
        is snap on parent and snap-position on child -->
    <div class="snap-x flex overflow-x-auto gap-5 pl-0.5 sm:snap-none sm:gap-14 sm:flex-wrap">
        <div class="snap-start p-5 w-72 shrink-0 relative">
            <span class="absolute w-3/12 h-0.5 bg-secondary top-[45%] left-[45%] animate-borderTop"></span>
            <span class="absolute w-3/12 h-0.5 bg-secondary top-[45%] left-[45%] origin-left rotate-90 animate-borderLeft"></span>
            <h3 class="text-xl font-bold text-btn-sec mb-2 inline-block opacity-0 scale-50 animate-projectsScale">Title</h3>
            <p class="mb-2 opacity-0 scale-20 animate-projectsScale">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque
                ipsa ullam similique, consequuntur dicta sint quae numquam
                deleniti dolorem harum repellendus ipsum et modi ad tempora? Est
                architecto mollitia hic.
            </p>
            <div class="flex justify-around mb-2 text-secondary">
                <button class="text-white bg-secondary rounded p-1 text-sm hover:bg-primary hover:text-secondary opacity-0 scale-20 animate-projectsScale">
                    Aller sur le site
                </button>
                <button class="text-white bg-secondary rounded p-1 text-sm hover:bg-primary hover:text-secondary opacity-0 scale-20 animate-projectsScale">
                    En savoir plus
                </button>
            </div>
            <div class="flex justify-end gap-2">
                <img src="../../public/assets/images/icons/react_mono.png" alt="" class="w-5 opacity-0 scale-20 animate-projectsScale" />
                <img src="../../public/assets/images/icons/javascript_mono.svg" alt="" class="w-5 opacity-0 scale-20 animate-projectsScale" />
                <img src="../../public/assets/images/icons/docker_mono.svg" alt="" class="w-5 opacity-0 scale-20 animate-projectsScale" />
            </div>
            <span class="absolute w-3/12 h-0.5 bg-secondary bottom-[45%] right-[45%] animate-borderRight"></span>
            <span class="absolute w-3/12 h-0.5 bg-secondary bottom-[45%] right-[45%]  animate-borderBottom rotate-90 origin-right"></span>
        </div>
        <div class="snap-start p-5 w-72 shrink-0 relative">
            <span class="absolute w-3/12 h-0.5 bg-secondary top-[45%] left-[45%] animate-borderTop"></span>
            <span class="absolute w-3/12 h-0.5 bg-secondary top-[45%] left-[45%] origin-left rotate-90 animate-borderLeft"></span>
            <h3 class="text-xl font-bold text-btn-sec mb-2 inline-block opacity-0 scale-50 animate-projectsScale">Title</h3>
            <p class="mb-2 opacity-0 scale-20 animate-projectsScale">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque
                ipsa ullam similique, consequuntur dicta sint quae numquam
                deleniti dolorem harum repellendus ipsum et modi ad tempora? Est
                architecto mollitia hic.
            </p>
            <div class="flex justify-around mb-2 text-secondary">
                <button class="text-white bg-secondary rounded p-1 text-sm hover:bg-primary hover:text-secondary opacity-0 scale-20 animate-projectsScale">
                    Aller sur le site
                </button>
                <button class="text-white bg-secondary rounded p-1 text-sm hover:bg-primary hover:text-secondary opacity-0 scale-20 animate-projectsScale">
                    En savoir plus
                </button>
            </div>
            <div class="flex justify-end gap-2">
                <img src="../../public/assets/images/icons/react_mono.png" alt="" class="w-5 opacity-0 scale-20 animate-projectsScale" />
                <img src="../../public/assets/images/icons/javascript_mono.svg" alt="" class="w-5 opacity-0 scale-20 animate-projectsScale" />
                <img src="../../public/assets/images/icons/docker_mono.svg" alt="" class="w-5 opacity-0 scale-20 animate-projectsScale" />
            </div>
            <span class="absolute w-3/12 h-0.5 bg-secondary bottom-[45%] right-[45%] animate-borderRight"></span>
            <span class="absolute w-3/12 h-0.5 bg-secondary bottom-[45%] right-[45%]  animate-borderBottom rotate-90 origin-right"></span>
        </div>
        <div class="snap-start p-5 w-72 shrink-0 relative">
            <span class="absolute w-3/12 h-0.5 bg-secondary top-[45%] left-[45%] animate-borderTop"></span>
            <span class="absolute w-3/12 h-0.5 bg-secondary top-[45%] left-[45%] origin-left rotate-90 animate-borderLeft"></span>
            <h3 class="text-xl font-bold text-btn-sec mb-2 inline-block opacity-0 scale-50 animate-projectsScale">Title</h3>
            <p class="mb-2 opacity-0 scale-20 animate-projectsScale">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque
                ipsa ullam similique, consequuntur dicta sint quae numquam
                deleniti dolorem harum repellendus ipsum et modi ad tempora? Est
                architecto mollitia hic.
            </p>
            <div class="flex justify-around mb-2 text-secondary">
                <button class="text-white bg-secondary rounded p-1 text-sm hover:bg-primary hover:text-secondary opacity-0 scale-20 animate-projectsScale">
                    Aller sur le site
                </button>
                <button class="text-white bg-secondary rounded p-1 text-sm hover:bg-primary hover:text-secondary opacity-0 scale-20 animate-projectsScale">
                    En savoir plus
                </button>
            </div>
            <div class="flex justify-end gap-2">
                <img src="../../public/assets/images/icons/react_mono.png" alt="" class="w-5 opacity-0 scale-20 animate-projectsScale" />
                <img src="../../public/assets/images/icons/javascript_mono.svg" alt="" class="w-5 opacity-0 scale-20 animate-projectsScale" />
                <img src="../../public/assets/images/icons/docker_mono.svg" alt="" class="w-5 opacity-0 scale-20 animate-projectsScale" />
            </div>
            <span class="absolute w-3/12 h-0.5 bg-secondary bottom-[45%] right-[45%] animate-borderRight"></span>
            <span class="absolute w-3/12 h-0.5 bg-secondary bottom-[45%] right-[45%]  animate-borderBottom rotate-90 origin-right"></span>
        </div>
    </div>
    <button class="bg-btn-sec rounded flex p-2.5 justify-between items-center mt-5 w-64">
        <p class="text-white">Voir toutes les projets</p>
        <img src="../../public/assets/images/icons/arrow-right-circle.svg" alt="" />
    </button>
</section>
<section>
    <h2 class="text-2xl text-secondary uppercase font-bold my-10 sm:w-6/12 sm:mt-12">
        Mes technos
    </h2>
    <div class="snap-x flex overflow-x-auto gap-5 pl-0.5 sm:snap-none sm:gap-14 sm:flex-wrap">
        <div class="relative w-72 h-72 flex flex-wrap justify-between gap-7 snap-start shrink-0 p-7">
            <span class="absolute w-6/12 h-0.5 bg-secondary top-0 left-0"></span>
            <span class="absolute w-6/12 h-0.5 bg-secondary top-0 left-0 origin-top-left rotate-90"></span>
            <img src="../../public/assets/images/icons/react_mono.png" alt="" class="w-20 h-20" />
            <img src="../../public/assets/images/icons/javascript_mono.svg" alt="" class="w-20 h-20" />
            <img src="../../public/assets/images/icons/docker_mono.svg" alt="" class="w-20 h-20" />
            <span class="absolute w-6/12 h-0.5 bg-secondary bottom-0 right-0"></span>
            <span class="absolute w-6/12 h-0.5 bg-secondary bottom-0 right-0 origin-top-right rotate-90"></span>
        </div>
        <div class="relative w-72 h-72 flex flex-wrap justify-between gap-7 snap-start shrink-0 p-7">
            <span class="absolute w-6/12 h-0.5 bg-secondary top-0 left-0"></span>
            <span class="absolute w-6/12 h-0.5 bg-secondary top-0 left-0 origin-top-left rotate-90"></span>
            <img src="../../public/assets/images/icons/react_mono.png" alt="" class="w-20 h-20" />
            <img src="../../public/assets/images/icons/javascript_mono.svg" alt="" class="w-20 h-20" />
            <img src="../../public/assets/images/icons/docker_mono.svg" alt="" class="w-20 h-20" />
            <span class="absolute w-6/12 h-0.5 bg-secondary bottom-0 right-0"></span>
            <span class="absolute w-6/12 h-0.5 bg-secondary bottom-0 right-0 origin-top-right rotate-90"></span>
        </div>
        <div class="relative w-72 h-72 flex flex-wrap justify-between gap-7 snap-start shrink-0 p-7">
            <span class="absolute w-6/12 h-0.5 bg-secondary top-0 left-0"></span>
            <span class="absolute w-6/12 h-0.5 bg-secondary top-0 left-0 origin-top-left rotate-90"></span>
            <img src="../../public/assets/images/icons/react_mono.png" alt="" class="w-20 h-20" />
            <img src="../../public/assets/images/icons/javascript_mono.svg" alt="" class="w-20 h-20" />
            <img src="../../public/assets/images/icons/docker_mono.svg" alt="" class="w-20 h-20" />
            <span class="absolute w-6/12 h-0.5 bg-secondary bottom-0 right-0"></span>
            <span class="absolute w-6/12 h-0.5 bg-secondary bottom-0 right-0 origin-top-right rotate-90"></span>
        </div>
    </div>
    <button class="bg-btn-sec rounded flex p-2.5 items-center  w-64 justify-between mt-5">
        <p class="text-white">Voir toutes les technos</p>
        <img src="../../public/assets/images/icons/arrow-right-circle.svg" alt="" />
    </button>
</section>