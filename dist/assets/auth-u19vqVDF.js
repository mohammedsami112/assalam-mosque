import{A as o}from"./Api-hy5XHh9_.js";const r={login(t){return o.post("/auth/login",t).then(a=>a.data)},logout(){return o.post("/auth/logout").then(t=>t.data)}};export{r as A};
