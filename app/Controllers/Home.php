<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('home');
    }
    public function signin(): string
    {
        return view('signin');
    }
    public function dashboard(): string
    {
        return view('dashboard');
    }
    public function allleads(): string
    {
        return view('allleads');
    }
    public function createleads(): string
    {
        return view('createleads');
    }
    public function bulkuplead(): string
    {
        return view('bulkuplead');
    }
    public function allocatedleads(): string
    {
        return view('allocatedleads');
    }
    public function unallocatedleads(): string
    {
        return view('unallocatedleads');
    }
    public function selfassignleads(): string
    {
        return view('selfassignleads');
    }
    public function allcounselor(): string
    {
        return view('allcounselor');
    }
    public function createcounselor(): string
    {
        return view('createcounselor');
    }
    public function allstatus(): string
    {
        return view('allstatus');
    }
    public function createstatus(): string
    {
        return view('createstatus');
    }
    public function allsource(): string
    {
        return view('allsource');
    }
    public function createsource(): string
    {
        return view('createsource');
    }
    public function processapp(): string
    {
        return view('processapp');
    }
    public function reappform(): string
    {
        return view('reappform');
    }
    public function loghiscou(): string
    {
        return view('loghiscou');
    }
    public function loghisadm(): string
    {
        return view('loghisadm');
    }
    public function reportstats(): string
    {
        return view('reportstats');
    }






    public function test(): string
    {
        return view('test');
    }
    public function error_404(): string
    {
        return view('error_404');
    }
}
