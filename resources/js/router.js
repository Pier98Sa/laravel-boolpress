import Vue  from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Home from './pages/Home';
import About from './pages/About';
import Contact from './pages/Contact';
import Posts from './pages/Posts';
import SinglePost from './pages/SinglePost';
import ErrorPage from './pages/ErrorPage';

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/chi-siamo',
            name: 'about',
            component: About
        },
        {
            path: '/contatti',
            name: 'contact',
            component: Contact
        },
        {
            path: '/blog',
            name: 'blog',
            component: Posts
        },
        {
            path: '/blog/:slug',
            name: 'single-post',
            component: SinglePost
        },
        {   // rotta Catch All
            path: '/*',
            name: 'errorPage',
            component: ErrorPage
        }
    ]
});

export default router;