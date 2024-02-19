function loadPDF(pdfUrl, index) {
    const pdfViewer = document.getElementById('pdfViewer' + index);
    pdfjsLib.getDocument(pdfUrl).promise.then(pdf => {
        pdf.getPage(1).then(page => {
            const scale = 1.5;
            const viewport = page.getViewport({
                scale: scale
            });
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;
            const renderContext = {
                canvasContext: context,
                viewport: viewport
            };
            page.render(renderContext).promise.then(() => {
                pdfViewer.innerHTML = '';
                pdfViewer.appendChild(canvas);
            });
        });
    });
};