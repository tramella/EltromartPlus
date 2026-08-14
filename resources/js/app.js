import "./bootstrap";

import Alpine from "alpinejs";
import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

window.Alpine = Alpine;
window.gsap = gsap;
window.ScrollTrigger = ScrollTrigger;

Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    // Check prefers-reduced-motion
    const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    // Header reveal / elevation on scroll
    const header = document.querySelector(".nav-header");
    if (header) {
        window.addEventListener("scroll", () => {
            if (window.scrollY > 40) {
                header.classList.add("shadow-xl", "bg-slate-950/95", "backdrop-blur-md");
            } else {
                header.classList.remove("shadow-xl", "bg-slate-950/95", "backdrop-blur-md");
            }
        });
    }

    // Scroll to Top Button Handler
    const scrollTopBtn = document.getElementById("scrollToTopBtn");
    if (scrollTopBtn) {
        window.addEventListener("scroll", () => {
            if (window.scrollY > 350) {
                scrollTopBtn.classList.remove("opacity-0", "pointer-events-none", "translate-y-4");
                scrollTopBtn.classList.add("opacity-100", "pointer-events-auto", "translate-y-0");
            } else {
                scrollTopBtn.classList.add("opacity-0", "pointer-events-none", "translate-y-4");
                scrollTopBtn.classList.remove("opacity-100", "pointer-events-auto", "translate-y-0");
            }
        });

        scrollTopBtn.addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }

    if (prefersReducedMotion) return;

    // Hero Section Animation
    if (document.querySelector(".hero-animate")) {
        gsap.from(".hero-animate", {
            duration: 1,
            y: 30,
            opacity: 0,
            ease: "power2.out",
        });
    }

    // Section entrance animation on scroll with clearProps
    gsap.utils.toArray(".gsap-reveal").forEach((section) => {
        gsap.fromTo(
            section,
            { y: 35, opacity: 0 },
            {
                scrollTrigger: {
                    trigger: section,
                    start: "top 90%",
                    toggleActions: "play none none none",
                },
                duration: 0.8,
                y: 0,
                opacity: 1,
                ease: "power2.out",
                clearProps: "opacity,transform",
            }
        );
    });
});
