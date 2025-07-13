<?php

namespace App\Http\Controllers;

use App\Models\nft;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class NftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $username=session('username');
        if ($username == 'Admin') {
            $nfts = nft::all();
            return view('nft.index', compact('nfts'));
        }
        else
        {
            $nfts = Pengguna::where('name', '=', $username)->with('nft')->firstOrFail()->nft;
            return view('nft.index', compact('nfts'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $username=session('username');
        if ($username == 'Admin') 
        {
            $penggunas = Pengguna::all();
            $nfts = nft::all();
            return view('admin.create-nft', compact('penggunas', 'nfts'));
        }
        else
        {
            $penggunas = Pengguna::where('name', '=', $username)->first();
            $nfts = nft::all();
            return view('pengguna.create-nft', compact('penggunas', 'nfts'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image_link' => 'required|url|unique:TabelNFT,image_link',
            'owner_uid' => 'required|exists:TabelPengguna,uid',
        ],
        [
            'name.required' => 'Name can\'t be empty!',
            'description.required' => 'Description can\'t be empty!',
            'image_link.required' => 'Image Link can\'t be empty!',
            'image_link.url' => 'Image Link must be a valid URL',
            'image_link.unique' => 'Image already belongs to someone else',
            'owner_uid.required' => 'Owner id can\'t be empty!!',
            'owner_uid.exist' => 'Owner id must be present in the user list',
        ]);

        nft::create([
            'name' => $request->name,
            'description' => $request->description,
            'image_link' => $request->image_link,
            'owner_uid' => $request->owner_uid,
        ]);
    
        return redirect('/nft');
    }

    /**
     * Display the specified resource.
     */
    public function show(nft $nft)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $nft = nft::find($id);
        $pemilik = Pengguna::where('uid', '=', $nft->owner_uid)->first();
        return view('nft.edit', compact('nft', 'pemilik'));      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $nft = NFT::find($id);
        $nft->name = $request->input('name');
        $nft->description = $request->input('description');
        // handle image upload
        $nft->save();
        return redirect('/nft')->with('success', 'NFT updated successfully');      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $nft = NFT::findOrFail($id);
        $nft->delete();
    
        return redirect('/nft')->with('success', 'NFT deleted successfully');
    
    }
}
