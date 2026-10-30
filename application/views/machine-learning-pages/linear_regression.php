<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
  :root {
    --bg: #0f0f14;
    --surf: #181820;
    --surf2: #1e1e28;
    --bdr: #2c2c38;
    --acc: #f0c040;
    --grn: #4af0b0;
    --red: #f06060;
    --blu: #5b9cf6;
    --txt: #e0e0ee;
    --dim: #666680;
  }
  * { box-sizing: border-box; margin: 0; padding: 0; }
  html, body { width: 100%; height: 100%; overflow: hidden; }

  body {
    background: var(--bg);
    color: var(--txt);
    font-family: 'Segoe UI', system-ui, sans-serif;
    font-size: 13px;
    display: flex;
    flex-direction: column;
    height: 480px;
  }

  /* ── TOP BAR ── */
  .topbar {
    display: flex;
    align-items: center;
    background: var(--surf);
    border-bottom: 1px solid var(--bdr);
    padding: 0 8px;
    flex-shrink: 0;
    gap: 2px;
  }
  .bar-label {
    font-size: 9px;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--grn);
    font-weight: 600;
    margin-right: 8px;
    white-space: nowrap;
  }
  .tab {
    font-size: 10px;
    padding: 7px 10px;
    border: none;
    background: none;
    color: var(--dim);
    cursor: pointer;
    border-bottom: 2px solid transparent;
    transition: color .15s, border-color .15s;
    white-space: nowrap;
    letter-spacing: .04em;
  }
  .tab:hover { color: var(--txt); }
  .tab.on { color: var(--acc); border-bottom-color: var(--acc); }

  /* ── PANELS ── */
  .panels { flex: 1; overflow: hidden; position: relative; }
  .panel {
    display: none;
    width: 100%; height: 100%;
    padding: 10px 12px;
    gap: 10px;
  }
  .panel.on { display: flex; }

  /* ── SHARED LAYOUT ── */
  .col-main { flex: 1; display: flex; flex-direction: column; gap: 6px; min-width: 0; }
  .col-side { width: 170px; flex-shrink: 0; display: flex; flex-direction: column; gap: 6px; }

  canvas {
    width: 100%; display: block;
    border: 1px solid var(--bdr);
    border-radius: 4px;
    background: var(--surf);
    cursor: crosshair;
  }

  /* ── SIDE CARD ── */
  .card {
    background: var(--surf);
    border: 1px solid var(--bdr);
    border-radius: 5px;
    padding: 8px 10px;
    flex-shrink: 0;
  }
  .card-title {
    font-size: 9px;
    letter-spacing: .12em;
    text-transform: uppercase;
    color: var(--acc);
    margin-bottom: 6px;
    font-weight: 600;
  }
  .kv { display: flex; justify-content: space-between; padding: 3px 0; border-bottom: 1px solid var(--bdr); }
  .kv:last-child { border: none; }
  .kk { font-size: 10px; color: var(--dim); font-family: monospace; }
  .vv { font-size: 10px; color: var(--grn); font-family: monospace; font-weight: 600; }

  .hint {
    font-size: 10px;
    color: var(--dim);
    font-style: italic;
    line-height: 1.5;
    margin-bottom: 4px;
  }

  /* ── BUTTONS ── */
  .btn-row { display: flex; gap: 5px; flex-wrap: wrap; margin-top: 4px; }
  .btn {
    font-size: 9px;
    letter-spacing: .08em;
    text-transform: uppercase;
    padding: 4px 8px;
    border: 1px solid var(--bdr);
    border-radius: 3px;
    background: var(--surf2);
    color: var(--txt);
    cursor: pointer;
    transition: all .12s;
  }
  .btn:hover { background: var(--acc); border-color: var(--acc); color: #000; }
  .btn.d:hover { background: var(--red); border-color: var(--red); color: #fff; }

  /* ── SLIDERS ── */
  .sl-wrap { margin-bottom: 6px; }
  .sl-head { display: flex; justify-content: space-between; font-size: 10px; color: var(--dim); margin-bottom: 2px; }
  .sl-val { color: var(--grn); }
  input[type=range] { width: 100%; accent-color: var(--acc); height: 3px; cursor: pointer; }

  /* ── LOG ── */
  .log {
    font-family: monospace;
    font-size: 9px;
    color: var(--dim);
    max-height: 70px;
    overflow-y: auto;
    background: var(--bg);
    border: 1px solid var(--bdr);
    border-radius: 3px;
    padding: 4px 6px;
    line-height: 1.6;
    margin-top: 4px;
  }
  .log span { color: var(--grn); }

  /* ── PROGRESS BAR ── */
  .bar-track { height: 5px; background: var(--surf2); border-radius: 3px; overflow: hidden; margin-top: 2px; }
  .bar-fill { height: 100%; background: linear-gradient(90deg, var(--grn), var(--acc)); border-radius: 3px; transition: width .3s; }

  /* ── PREDICTION ── */
  .pred-scenarios { display: flex; gap: 5px; margin-bottom: 8px; flex-wrap: wrap; }
  .sc-btn {
    font-size: 9px; padding: 4px 8px;
    border: 1px solid var(--bdr); border-radius: 3px;
    background: var(--surf2); color: var(--dim);
    cursor: pointer; transition: all .12s;
  }
  .sc-btn:hover { border-color: var(--acc); color: var(--txt); }
  .sc-btn.on { border-color: var(--acc); color: var(--acc); background: #1e1a08; }

  .pred-result {
    background: linear-gradient(135deg, #1a1800, #0c1510);
    border: 1px solid var(--acc);
    border-radius: 5px;
    padding: 8px 12px;
    text-align: center;
    margin-top: 6px;
  }
  .pr-label { font-size: 9px; color: var(--dim); letter-spacing: .1em; text-transform: uppercase; }
  .pr-value { font-size: 2rem; font-weight: 700; color: var(--acc); line-height: 1.1; }
  .pr-eq { font-family: monospace; font-size: 10px; color: var(--grn); margin-top: 4px; }

  /* ── LEGEND ── */
  .leg-row { display: flex; align-items: center; gap: 5px; font-size: 10px; color: var(--dim); margin-bottom: 3px; }
  .leg-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
</style>
</head>
<body>

<!-- TOP BAR -->
<div class="topbar">
  <span class="bar-label">📐 Linear Regression</span>
  <button class="tab on" onclick="go(0,this)">① Draw & Fit</button>
  <button class="tab" onclick="go(1,this)">② Gradient Descent</button>
  <button class="tab" onclick="go(2,this)">③ Prediction</button>
  <button class="tab" onclick="go(3,this)">④ Residuals</button>
</div>

<div class="panels">

  <!-- ══ TAB 0: DRAW & FIT ══ -->
  <div class="panel on" id="p0">
    <div class="col-main">
      <canvas id="c0" height="380"></canvas>
    </div>
    <div class="col-side">
      <div class="card">
        <div class="card-title">Live Stats</div>
        <p class="hint">Click canvas to add points.</p>
        <div class="kv"><span class="kk">Points</span><span class="vv" id="s0n">0</span></div>
        <div class="kv"><span class="kk">β₀</span><span class="vv" id="s0b0">—</span></div>
        <div class="kv"><span class="kk">β₁</span><span class="vv" id="s0b1">—</span></div>
        <div class="kv"><span class="kk">R²</span><span class="vv" id="s0r2">—</span></div>
        <div class="kv"><span class="kk">MSE</span><span class="vv" id="s0mse">—</span></div>
        <div class="btn-row">
          <button class="btn" onclick="loadPreset()">Example</button>
          <button class="btn d" onclick="clearDraw()">Clear</button>
        </div>
      </div>
    </div>
  </div>

  <!-- ══ TAB 1: GRADIENT DESCENT ══ -->
  <div class="panel" id="p1">
    <div class="col-main">
      <canvas id="c1" height="230"></canvas>
      <canvas id="c1loss" height="140"></canvas>
    </div>
    <div class="col-side">
      <div class="card">
        <div class="card-title">Controls</div>
        <div class="sl-wrap">
          <div class="sl-head"><span>Learning Rate</span><span class="sl-val" id="lrv">0.010</span></div>
          <input type="range" id="lrSl" min=".001" max=".05" step=".001" value=".01" oninput="lrv.textContent=parseFloat(this.value).toFixed(3)">
        </div>
        <div class="sl-wrap">
          <div class="sl-head"><span>Steps / click</span><span class="sl-val" id="stv">10</span></div>
          <input type="range" id="stSl" min="1" max="100" step="1" value="10" oninput="stv.textContent=this.value">
        </div>
        <div class="btn-row">
          <button class="btn" onclick="gdStep()">▶ Step</button>
          <button class="btn" onclick="gdAuto()" id="autoBtn">⟳ Auto</button>
          <button class="btn d" onclick="gdReset()">Reset</button>
        </div>
        <div style="margin-top:6px">
          <div class="kv"><span class="kk">Epoch</span><span class="vv" id="gde">0</span></div>
          <div class="kv"><span class="kk">β₀</span><span class="vv" id="gdb0">0.00</span></div>
          <div class="kv"><span class="kk">β₁</span><span class="vv" id="gdb1">0.00</span></div>
          <div class="kv"><span class="kk">Loss</span><span class="vv" id="gdloss">—</span></div>
        </div>
        <div class="sl-head" style="margin-top:5px"><span>Convergence</span></div>
        <div class="bar-track"><div class="bar-fill" id="convBar" style="width:0%"></div></div>
        <div class="log" id="gdlog">Press Step or Auto…</div>
      </div>
    </div>
  </div>

  <!-- ══ TAB 2: PREDICTION ══ -->
  <div class="panel" id="p2">
    <div class="col-main">
      <div class="pred-scenarios" id="scRow"></div>
      <canvas id="c2" height="260"></canvas>
    </div>
    <div class="col-side">
      <div class="card">
        <div class="card-title" id="scTitle">Study Hours</div>
        <div class="sl-wrap">
          <div class="sl-head"><span id="xLab">Hours Studied</span><span class="sl-val" id="xvd">5.0</span></div>
          <input type="range" id="xSl" min="1" max="12" step=".1" value="5" oninput="updPred()">
        </div>
        <div class="pred-result">
          <div class="pr-label" id="prlabel">Predicted Score</div>
          <div class="pr-value" id="prval">—</div>
          <div class="pr-eq" id="preq">Y = β₀ + β₁·X</div>
        </div>
        <div style="margin-top:8px">
          <div class="kv"><span class="kk">β₀</span><span class="vv" id="prb0">—</span></div>
          <div class="kv"><span class="kk">β₁</span><span class="vv" id="prb1">—</span></div>
          <div class="kv"><span class="kk">Input X</span><span class="vv" id="prx">—</span></div>
        </div>
      </div>
    </div>
  </div>

  <!-- ══ TAB 3: RESIDUALS ══ -->
  <div class="panel" id="p3">
    <div class="col-main">
      <canvas id="c3" height="230"></canvas>
      <canvas id="c3r" height="140"></canvas>
    </div>
    <div class="col-side">
      <div class="card">
        <div class="card-title">Legend</div>
        <div class="leg-row"><div class="leg-dot" style="background:var(--blu)"></div>Actual point</div>
        <div class="leg-row"><div class="leg-dot" style="background:var(--acc)"></div>Predicted (line)</div>
        <div class="leg-row"><div class="leg-dot" style="background:var(--red)"></div>Pos. residual</div>
        <div class="leg-row"><div class="leg-dot" style="background:var(--grn)"></div>Neg. residual</div>
        <div class="card-title" style="margin-top:8px">Metrics</div>
        <div class="kv"><span class="kk">MAE</span><span class="vv" id="rMAE">—</span></div>
        <div class="kv"><span class="kk">MSE</span><span class="vv" id="rMSE">—</span></div>
        <div class="kv"><span class="kk">RMSE</span><span class="vv" id="rRMSE">—</span></div>
        <div class="kv"><span class="kk">R²</span><span class="vv" id="rR2">—</span></div>
        <div class="card-title" style="margin-top:8px">Hover a Point</div>
        <div class="kv"><span class="kk">X</span><span class="vv" id="hx">—</span></div>
        <div class="kv"><span class="kk">Actual Y</span><span class="vv" id="hy">—</span></div>
        <div class="kv"><span class="kk">Ŷ</span><span class="vv" id="hyh">—</span></div>
        <div class="kv"><span class="kk">Residual</span><span class="vv" id="hres">—</span></div>
        <button class="btn" style="margin-top:6px;width:100%" onclick="shuffleR()">Shuffle Data</button>
      </div>
    </div>
  </div>

</div>

<script>
/* ═══════════════════════════════════════
   UTILS
═══════════════════════════════════════ */
const $ = id => document.getElementById(id);
const PAD = 28;

function linReg(xs, ys) {
  const n = xs.length; if (n < 2) return null;
  const mx = xs.reduce((a,b)=>a+b,0)/n, my = ys.reduce((a,b)=>a+b,0)/n;
  let num=0, den=0;
  for (let i=0;i<n;i++) { num+=(xs[i]-mx)*(ys[i]-my); den+=(xs[i]-mx)**2; }
  if (!den) return null;
  const b1=num/den, b0=my-b1*mx; return {b0,b1};
}
function mse(xs,ys,b0,b1){ return xs.reduce((s,x,i)=>s+(ys[i]-(b0+b1*x))**2,0)/xs.length; }
function r2(xs,ys,b0,b1){ const my=ys.reduce((a,b)=>a+b,0)/ys.length, ss_res=xs.reduce((s,x,i)=>s+(ys[i]-(b0+b1*x))**2,0), ss_tot=ys.reduce((s,y)=>s+(y-my)**2,0); return ss_tot?1-ss_res/ss_tot:1; }

function initCanvas(c, h) {
  const dpr = devicePixelRatio||1;
  const w = c.getBoundingClientRect().width||300;
  c.width = w*dpr; c.height = h*dpr;
  const ctx = c.getContext('2d'); ctx.scale(dpr,dpr);
  return {ctx, w, h};
}
function grid(ctx,w,h){
  ctx.strokeStyle='#2a2a3e'; ctx.lineWidth=1;
  for(let i=0;i<=8;i++){const x=i/8*w; ctx.beginPath();ctx.moveTo(x,0);ctx.lineTo(x,h);ctx.stroke();}
  for(let i=0;i<=6;i++){const y=i/6*h; ctx.beginPath();ctx.moveTo(0,y);ctx.lineTo(w,y);ctx.stroke();}
  // axis lines
  ctx.strokeStyle='#5a5a7a'; ctx.lineWidth=1.5;
  ctx.beginPath(); ctx.moveTo(PAD,4); ctx.lineTo(PAD,h-PAD); ctx.lineTo(w-4,h-PAD); ctx.stroke();
}
function tx(v,mn,mx,W,p=PAD){ return p+(v-mn)/(mx-mn)*(W-2*p); }
function ty(v,mn,mx,H,p=PAD){ return p+(v-mn)/(mx-mn)*(H-2*p); }
function fx(px,mn,mx,W,p=PAD){ return mn+(px-p)/(W-2*p)*(mx-mn); }
function fy(py,mn,mx,H,p=PAD){ return mn+(py-p)/(H-2*p)*(mx-mn); }

/* ═══════════════════════════════════════
   TAB SWITCHING
═══════════════════════════════════════ */
function go(i, btn) {
  document.querySelectorAll('.panel').forEach((p,j)=>p.classList.toggle('on',j===i));
  document.querySelectorAll('.tab').forEach((b,j)=>b.classList.toggle('on',j===i));
  if(i===0) setTimeout(()=>drawD(),30);
  if(i===1) setTimeout(()=>{drawGD();drawLoss();},30);
  if(i===2) setTimeout(()=>drawP(parseFloat($('xSl').value)),30);
  if(i===3) setTimeout(()=>{drawR();drawRP();calcRM();},30);
}

/* ═══════════════════════════════════════
   TAB 0 — DRAW & FIT
═══════════════════════════════════════ */
let pts = [];

$('c0').addEventListener('click', e => {
  const c=$('c0'), rect=c.getBoundingClientRect();
  const x=e.clientX-rect.left, y=e.clientY-rect.top;
  const w=rect.width, h=rect.height;
  if(x<PAD||x>w-PAD||y<PAD||y>h-PAD) return;
  pts.push({x:fx(x,0,10,w), y:fy(y,100,0,h)});
  drawD();
});

function drawD() {
  const c=$('c0'); if(!c.getBoundingClientRect().width) return;
  const {ctx,w,h}=initCanvas(c,380);
  ctx.fillStyle='#0f0f14'; ctx.fillRect(0,0,w,h);
  grid(ctx,w,h);
  const xs=pts.map(p=>p.x), ys=pts.map(p=>p.y);
  // axes ticks
  ctx.font='9px monospace'; ctx.fillStyle='#888899'; ctx.textAlign='center';
  for(let v=0;v<=10;v+=2) ctx.fillText(v, tx(v,0,10,w), h-6);
  ctx.textAlign='right';
  for(let v=0;v<=100;v+=20) ctx.fillText(v, PAD-4, ty(v,100,0,h)+3);

  if(pts.length>=2){
    const r=linReg(xs,ys);
    if(r){
      const {b0,b1}=r;
      // residual dashes
      ctx.lineWidth=1; ctx.setLineDash([3,3]);
      for(let i=0;i<pts.length;i++){
        const px=tx(xs[i],0,10,w), pa=ty(ys[i],100,0,h), pp=ty(b0+b1*xs[i],100,0,h);
        ctx.strokeStyle='rgba(240,96,96,.4)'; ctx.beginPath(); ctx.moveTo(px,pa); ctx.lineTo(px,pp); ctx.stroke();
      }
      ctx.setLineDash([]);
      // line
      ctx.strokeStyle='#f0c040'; ctx.lineWidth=2;
      ctx.beginPath();
      ctx.moveTo(tx(0,0,10,w), ty(b0,100,0,h));
      ctx.lineTo(tx(10,0,10,w), ty(b0+b1*10,100,0,h));
      ctx.stroke();
      $('s0b0').textContent=b0.toFixed(3);
      $('s0b1').textContent=b1.toFixed(3);
      $('s0r2').textContent=r2(xs,ys,b0,b1).toFixed(4);
      $('s0mse').textContent=mse(xs,ys,b0,b1).toFixed(2);
    }
  } else {
    ['s0b0','s0b1','s0r2','s0mse'].forEach(id=>$(id).textContent='—');
  }
  for(const p of pts){
    const px=tx(p.x,0,10,w), py=ty(p.y,100,0,h);
    ctx.beginPath(); ctx.arc(px,py,5,0,Math.PI*2);
    ctx.fillStyle='#5b9cf6'; ctx.fill();
    ctx.strokeStyle='#fff'; ctx.lineWidth=.8; ctx.stroke();
  }
  $('s0n').textContent=pts.length;
}

function clearDraw(){ pts=[]; drawD(); }
function loadPreset(){
  pts=[{x:1,y:35},{x:2,y:45},{x:3,y:50},{x:4,y:60},{x:5,y:65},{x:6,y:75},{x:7,y:80},{x:8,y:88}];
  drawD();
}

/* ═══════════════════════════════════════
   TAB 1 — GRADIENT DESCENT
═══════════════════════════════════════ */
const GDX=[1,2,3,4,5,6,7,8], GDY=[35,45,50,60,65,75,80,88];
let b0=0,b1=0,ep=0,losses=[],autoT=null;

function gdGrad(){ const n=GDX.length; let g0=0,g1=0; for(let i=0;i<n;i++){const e=(b0+b1*GDX[i])-GDY[i]; g0+=e; g1+=e*GDX[i];} return{g0:g0/n,g1:g1/n}; }

function gdStep(){
  const lr=parseFloat($('lrSl').value), st=parseInt($('stSl').value);
  for(let s=0;s<st;s++){
    const g=gdGrad(); b0-=lr*g.g0; b1-=lr*g.g1; ep++;
    losses.push(mse(GDX,GDY,b0,b1));
  }
  const l=losses[losses.length-1];
  $('gde').textContent=ep;
  $('gdb0').textContent=b0.toFixed(4);
  $('gdb1').textContent=b1.toFixed(4);
  $('gdloss').textContent=l.toFixed(4);
  const init=losses[0]||1;
  $('convBar').style.width=Math.min(100,Math.max(0,(1-l/init)*100))+'%';
  const log=$('gdlog');
  log.innerHTML+=`<div>Ep <span>${ep}</span> Loss: <span>${l.toFixed(4)}</span></div>`;
  log.scrollTop=log.scrollHeight;
  drawGD(); drawLoss();
}

function gdAuto(){
  if(autoT){clearInterval(autoT);autoT=null;$('autoBtn').textContent='⟳ Auto';return;}
  $('autoBtn').textContent='■ Stop';
  autoT=setInterval(()=>{ gdStep(); if((losses[losses.length-1]||9999)<0.5){clearInterval(autoT);autoT=null;$('autoBtn').textContent='⟳ Auto';} },80);
}

function gdReset(){
  if(autoT){clearInterval(autoT);autoT=null;$('autoBtn').textContent='⟳ Auto';}
  b0=0;b1=0;ep=0;losses=[];
  $('gde').textContent=0; $('gdb0').textContent='0.00'; $('gdb1').textContent='0.00'; $('gdloss').textContent='—';
  $('convBar').style.width='0%'; $('gdlog').innerHTML='Press Step or Auto…';
  drawGD(); drawLoss();
}

function drawGD(){
  const c=$('c1'); if(!c.getBoundingClientRect().width) return;
  const H=230; const {ctx,w,h}=initCanvas(c,H);
  ctx.fillStyle='#0f0f14'; ctx.fillRect(0,0,w,h); grid(ctx,w,h);
  const xmn=0,xmx=10,ymn=0,ymx=110;
  // tick labels
  ctx.font='9px monospace'; ctx.fillStyle='#888899'; ctx.textAlign='center';
  for(let v=0;v<=10;v+=2) ctx.fillText(v, tx(v,xmn,xmx,w), h-6);
  ctx.textAlign='right';
  for(let v=0;v<=100;v+=20) ctx.fillText(v, PAD-4, ty(v,ymx,ymn,h)+3);
  const best=linReg(GDX,GDY);
  if(best){
    ctx.strokeStyle='rgba(74,240,176,.2)'; ctx.lineWidth=1.5; ctx.setLineDash([4,4]);
    ctx.beginPath();
    ctx.moveTo(tx(xmn,xmn,xmx,w),ty(best.b0+best.b1*xmn,ymx,ymn,h));
    ctx.lineTo(tx(xmx,xmn,xmx,w),ty(best.b0+best.b1*xmx,ymx,ymn,h));
    ctx.stroke(); ctx.setLineDash([]);
  }
  ctx.strokeStyle='#f0c040'; ctx.lineWidth=2; ctx.setLineDash([]);
  ctx.beginPath();
  ctx.moveTo(tx(xmn,xmn,xmx,w),ty(b0+b1*xmn,ymx,ymn,h));
  ctx.lineTo(tx(xmx,xmn,xmx,w),ty(b0+b1*xmx,ymx,ymn,h));
  ctx.stroke();
  for(let i=0;i<GDX.length;i++){
    const px=tx(GDX[i],xmn,xmx,w), py=ty(GDY[i],ymx,ymn,h);
    ctx.beginPath(); ctx.arc(px,py,4,0,Math.PI*2);
    ctx.fillStyle='#5b9cf6'; ctx.fill();
  }
}

function drawLoss(){
  const c=$('c1loss'); if(!c.getBoundingClientRect().width) return;
  const {ctx,w,h}=initCanvas(c,140);
  ctx.fillStyle='#0f0f14'; ctx.fillRect(0,0,w,h); grid(ctx,w,h);
  ctx.font='9px monospace'; ctx.fillStyle='#666677'; ctx.textAlign='center';
  ctx.fillText('Loss curve', w/2, h-5);
  if(losses.length<2) return;
  const maxL=Math.max(...losses.slice(0,5))||1, n=losses.length;
  ctx.strokeStyle='#f06060'; ctx.lineWidth=1.5; ctx.beginPath();
  for(let i=0;i<n;i++){
    const px=tx(i,0,n-1,w), py=ty(losses[i],maxL,0,h);
    i?ctx.lineTo(px,py):ctx.moveTo(px,py);
  }
  ctx.stroke();
  const lx=tx(n-1,0,n-1,w), ly=ty(losses[n-1],maxL,0,h);
  ctx.beginPath(); ctx.arc(lx,ly,3,0,Math.PI*2); ctx.fillStyle='#f0c040'; ctx.fill();
}

/* ═══════════════════════════════════════
   TAB 2 — PREDICTION
═══════════════════════════════════════ */
const SC=[
  {name:'📚 Exam',xLab:'Hours Studied',yLab:'Score',xmn:0,xmx:12,ymn:0,ymx:120,unit:'marks',b0:25,b1:8,pl:'Predicted Score',
   data:[{x:1,y:35},{x:2,y:45},{x:3,y:50},{x:4,y:60},{x:5,y:65},{x:6,y:75},{x:7,y:80},{x:8,y:88}]},
  {name:'🏠 House',xLab:'Area (100 sqft)',yLab:'$000',xmn:5,xmx:40,ymn:50,ymx:500,unit:'×$1k',b0:50,b1:10.5,pl:'Predicted Price',
   data:[{x:8,y:134},{x:12,y:176},{x:15,y:210},{x:18,y:240},{x:22,y:285},{x:25,y:315},{x:30,y:370},{x:35,y:420}]},
  {name:'🌡️ Temp',xLab:'Month',yLab:'°C',xmn:1,xmx:12,ymn:0,ymx:45,unit:'°C',b0:10,b1:2.1,pl:'Predicted Temp',
   data:[{x:1,y:12},{x:2,y:14},{x:3,y:18},{x:4,y:23},{x:5,y:28},{x:6,y:33},{x:7,y:35},{x:8,y:34},{x:9,y:30},{x:10,y:24},{x:11,y:18},{x:12,y:13}]},
  {name:'📈 Sales',xLab:'Ad Spend ($k)',yLab:'$k',xmn:0,xmx:20,ymn:0,ymx:250,unit:'×$1k',b0:20,b1:10.8,pl:'Predicted Sales',
   data:[{x:2,y:42},{x:4,y:63},{x:6,y:85},{x:8,y:110},{x:10,y:130},{x:12,y:152},{x:15,y:180},{x:18,y:215}]}
];
let curSC=0;

(function buildScBtns(){
  const row=$('scRow');
  SC.forEach((s,i)=>{
    const b=document.createElement('button');
    b.className='sc-btn'+(i===0?' on':'');
    b.textContent=s.name;
    b.onclick=()=>{
      curSC=i;
      document.querySelectorAll('.sc-btn').forEach((x,j)=>x.classList.toggle('on',j===i));
      $('scTitle').textContent=s.name;
      $('xLab').textContent=s.xLab;
      const sl=$('xSl'); sl.min=s.xmn; sl.max=s.xmx; sl.value=(s.xmn+s.xmx)/2;
      $('prb0').textContent=s.b0; $('prb1').textContent=s.b1;
      updPred();
    };
    row.appendChild(b);
  });
})();

function updPred(){
  const s=SC[curSC], x=parseFloat($('xSl').value);
  $('xvd').textContent=x.toFixed(1);
  const y=s.b0+s.b1*x;
  $('prlabel').textContent=s.pl;
  $('prval').textContent=Math.round(y);
  $('preq').textContent=`Ŷ = ${s.b0} + ${s.b1}×${x.toFixed(1)} = ${Math.round(y)}`;
  $('prb0').textContent=s.b0; $('prb1').textContent=s.b1; $('prx').textContent=x.toFixed(1);
  drawP(x);
}

$('xSl').addEventListener('input', updPred);

function drawP(xv){
  const s=SC[curSC], c=$('c2'); if(!c.getBoundingClientRect().width) return;
  const {ctx,w,h}=initCanvas(c,260);
  ctx.fillStyle='#0f0f14'; ctx.fillRect(0,0,w,h); grid(ctx,w,h);
  const {xmn,xmx,ymn,ymx}=s;
  // tick labels
  ctx.font='9px monospace'; ctx.fillStyle='#888899'; ctx.textAlign='center';
  const xstep=Math.ceil((xmx-xmn)/6);
  for(let v=xmn;v<=xmx;v+=xstep) ctx.fillText(v, tx(v,xmn,xmx,w), h-6);
  ctx.textAlign='right';
  const ystep=Math.ceil((ymx-ymn)/5/10)*10||Math.ceil((ymx-ymn)/5);
  for(let v=ymn;v<=ymx;v+=ystep) ctx.fillText(v, PAD-4, ty(v,ymx,ymn,h)+3);
  ctx.strokeStyle='#f0c040'; ctx.lineWidth=2;
  ctx.beginPath();
  ctx.moveTo(tx(xmn,xmn,xmx,w),ty(s.b0+s.b1*xmn,ymx,ymn,h));
  ctx.lineTo(tx(xmx,xmn,xmx,w),ty(s.b0+s.b1*xmx,ymx,ymn,h));
  ctx.stroke();
  for(const p of s.data){
    ctx.beginPath(); ctx.arc(tx(p.x,xmn,xmx,w),ty(p.y,ymx,ymn,h),3.5,0,Math.PI*2);
    ctx.fillStyle='rgba(91,156,246,.7)'; ctx.fill();
  }
  const px=tx(xv,xmn,xmx,w), py=ty(s.b0+s.b1*xv,ymx,ymn,h);
  ctx.strokeStyle='rgba(240,192,64,.3)'; ctx.lineWidth=1; ctx.setLineDash([4,4]);
  ctx.beginPath(); ctx.moveTo(px,h-PAD); ctx.lineTo(px,py); ctx.stroke(); ctx.setLineDash([]);
  ctx.beginPath(); ctx.arc(px,py,6,0,Math.PI*2);
  ctx.fillStyle='#f0c040'; ctx.fill(); ctx.strokeStyle='#fff'; ctx.lineWidth=1; ctx.stroke();
  ctx.font='9px monospace'; ctx.fillStyle='#666677'; ctx.textAlign='center';
  ctx.fillText(`${s.xLab} →`, w/2, h-5);
}

/* ═══════════════════════════════════════
   TAB 3 — RESIDUALS
═══════════════════════════════════════ */
let RD=[];

function genRD(){ RD=[]; for(let x=1;x<=10;x++) RD.push({x,y:Math.round(25+8.2*x+(Math.random()-.5)*18)}); }
function shuffleR(){ genRD(); drawR(); drawRP(); calcRM(); ['hx','hy','hyh','hres'].forEach(id=>$(id).textContent='—'); }

function calcRM(){
  const xs=RD.map(p=>p.x), ys=RD.map(p=>p.y), r=linReg(xs,ys); if(!r) return;
  const n=xs.length; let mae=0,ms=0;
  for(let i=0;i<n;i++){const e=ys[i]-(r.b0+r.b1*xs[i]); mae+=Math.abs(e); ms+=e*e;}
  mae/=n; ms/=n;
  $('rMAE').textContent=mae.toFixed(3); $('rMSE').textContent=ms.toFixed(3);
  $('rRMSE').textContent=Math.sqrt(ms).toFixed(3); $('rR2').textContent=r2(xs,ys,r.b0,r.b1).toFixed(4);
}

function drawR(hi=-1){
  const c=$('c3'); if(!c.getBoundingClientRect().width) return;
  const {ctx,w,h}=initCanvas(c,230);
  ctx.fillStyle='#0f0f14'; ctx.fillRect(0,0,w,h); grid(ctx,w,h);
  const xs=RD.map(p=>p.x), ys=RD.map(p=>p.y), r=linReg(xs,ys); if(!r) return;
  const {b0,b1}=r, xmn=0,xmx=11,ymn=0,ymx=120;
  ctx.strokeStyle='#f0c040'; ctx.lineWidth=2;
  ctx.beginPath();
  ctx.moveTo(tx(xmn,xmn,xmx,w),ty(b0+b1*xmn,ymx,ymn,h));
  ctx.lineTo(tx(xmx,xmn,xmx,w),ty(b0+b1*xmx,ymx,ymn,h));
  ctx.stroke();
  for(let i=0;i<RD.length;i++){
    const p=RD[i], px=tx(p.x,xmn,xmx,w);
    const pa=ty(p.y,ymn,ymx,h), pp=ty(b0+b1*p.x,ymn,ymx,h);
    const res=p.y-(b0+b1*p.x), col=res>=0?'#f06060':'#4af0b0';
    ctx.strokeStyle=i===hi?col:col+'88'; ctx.lineWidth=i===hi?2:1.5; ctx.setLineDash([3,3]);
    ctx.beginPath(); ctx.moveTo(px,pa); ctx.lineTo(px,pp); ctx.stroke(); ctx.setLineDash([]);
    ctx.beginPath(); ctx.arc(px,pp,2.5,0,Math.PI*2); ctx.fillStyle='#f0c040'; ctx.fill();
    ctx.beginPath(); ctx.arc(px,pa,i===hi?6:4.5,0,Math.PI*2);
    ctx.fillStyle='#5b9cf6'; ctx.fill(); ctx.strokeStyle='#fff'; ctx.lineWidth=.7; ctx.stroke();
  }
}

function drawRP(){
  const c=$('c3r'); if(!c.getBoundingClientRect().width) return;
  const {ctx,w,h}=initCanvas(c,140);
  ctx.fillStyle='#0f0f14'; ctx.fillRect(0,0,w,h); grid(ctx,w,h);
  const xs=RD.map(p=>p.x), ys=RD.map(p=>p.y), r=linReg(xs,ys); if(!r) return;
  const res=xs.map((x,i)=>ys[i]-(r.b0+r.b1*x));
  const maxR=Math.max(...res.map(Math.abs))*1.5||1;
  ctx.strokeStyle='rgba(240,192,64,.4)'; ctx.lineWidth=1; ctx.setLineDash([4,4]);
  ctx.beginPath(); ctx.moveTo(PAD,ty(0,-maxR,maxR,h)); ctx.lineTo(w-PAD,ty(0,-maxR,maxR,h)); ctx.stroke(); ctx.setLineDash([]);
  for(let i=0;i<xs.length;i++){
    ctx.beginPath(); ctx.arc(tx(xs[i],0,11,w),ty(res[i],-maxR,maxR,h),4,0,Math.PI*2);
    ctx.fillStyle=res[i]>=0?'#f06060':'#4af0b0'; ctx.fill();
  }
  ctx.font='9px monospace'; ctx.fillStyle='#666677'; ctx.textAlign='center';
  ctx.fillText('Residual Plot', w/2, h-4);
}

$('c3').addEventListener('mousemove', e => {
  const c=$('c3'), rect=c.getBoundingClientRect();
  const mx=e.clientX-rect.left, my=e.clientY-rect.top;
  const w=rect.width,h=230;
  let best=-1, bd=15;
  for(let i=0;i<RD.length;i++){
    const px=tx(RD[i].x,0,11,w), py=ty(RD[i].y,0,120,h);
    const d=Math.hypot(mx-px,my-py);
    if(d<bd){best=i;bd=d;}
  }
  if(best>=0){
    const p=RD[best], r=linReg(RD.map(q=>q.x),RD.map(q=>q.y));
    if(r){
      const yh=r.b0+r.b1*p.x;
      $('hx').textContent=p.x; $('hy').textContent=p.y;
      $('hyh').textContent=yh.toFixed(2); $('hres').textContent=(p.y-yh).toFixed(2);
      drawR(best);
    }
  }
});

/* ═══════════════════════════════════════
   INIT
═══════════════════════════════════════ */
window.addEventListener('load',()=>{
  genRD();
  // Pre-draw hidden canvases with small delay
  setTimeout(()=>{
    drawD(); drawGD(); drawLoss();
    drawP(5); updPred();
    drawR(); drawRP(); calcRM();
    $('prb0').textContent=SC[0].b0; $('prb1').textContent=SC[0].b1;
    updPred();
  },200);
});
window.addEventListener('resize',()=>{
  drawD(); drawGD(); drawLoss();
  drawP(parseFloat($('xSl').value));
  drawR(); drawRP();
});
</script>
</body>
</html>
