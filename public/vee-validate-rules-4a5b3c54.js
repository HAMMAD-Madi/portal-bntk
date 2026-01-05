/**
  * vee-validate v4.15.1
  * (c) 2025 Abdelrahman Awad
  * @license MIT
  */function f(r,t){return Array.isArray(r)?r[0]:r[t]}function e(r){return!!(r==null||r===""||Array.isArray(r)&&r.length===0)}const i=/^(?!\.)(?!.*\.\.)([A-Z0-9_'+\-\.]*)[A-Z0-9_+-]@([A-Z0-9][A-Z0-9\-]*\.)+[A-Z]{2,}$/i,o=r=>e(r)?!0:Array.isArray(r)?r.every(t=>i.test(String(t))):i.test(String(r)),A=(r,t)=>{if(e(r))return!0;const n=f(t,"length");return Array.isArray(r)?r.every(s=>A(s,{length:n})):[...String(r)].length>=Number(n)};function u(r){return r==null}function y(r){return Array.isArray(r)&&r.length===0}const g=r=>u(r)||y(r)||r===!1?!1:!!String(r).trim().length;export{o as e,A as m,g as r};
