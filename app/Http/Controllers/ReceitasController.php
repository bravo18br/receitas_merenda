<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receita;

class ReceitasController extends Controller
{
    public function post_salvar_receita(Request $request)
    {
        $pdfFile = $request->file('pdfFile');
        $imageFile = $request->file('imageFile');
        $tituloReceita = $request->input('tituloReceita');

        $this->store($tituloReceita, $imageFile, $pdfFile);
        return 'Receita criada com sucesso!';
    }

    public function store($titulo, $imagem, $pdf)
    {
        $receita = new Receita();
    
        $receita->titulo = $titulo;
    
        $caminhoImagem = $imagem->store('public/imagens');
        $imagemNome = basename($caminhoImagem);
        $imagem->move(public_path('imagens'), $imagemNome);
        $receita->imagem = 'imagens/' . $imagemNome;
    
        $caminhoPDF = $pdf->store('public/pdfs');
        $pdfNome = basename($caminhoPDF);
        $pdf->move(public_path('pdfs'), $pdfNome);
        $receita->caminho_pdf = 'pdfs/' . $pdfNome;
    
        $receita->save();
    }

    public function get_receitas()
    {
        return Receita::buscarTodasReceitas();
    }

    public function get_receitas_modal_view()
    {
        $receitas = $this->get_receitas();
        return view('receitas_modal', ['receitas' => $receitas]);
    }

    public function get_gerenciar_receitas()
    {
        $receitas = $this->get_receitas();
        return view('gerenciar_receitas', ['receitas' => $receitas]);
    }

    public function excluir_receita($id)
    {
        $receita = Receita::findOrFail($id);
        $receita->delete();
    
        return redirect()->back()->with('success', 'Receita excluída com sucesso!');
    }

}
