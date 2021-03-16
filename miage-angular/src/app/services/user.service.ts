import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  private API_URL: string = "http://localhost:5000/api";

  constructor(private http: HttpClient) { }


  login (user: any){
    return this.http.post(this.API_URL+"/users",user,{observe: 'response'})
  }

  getAllUsers(){
    return this.http.get(this.API_URL+"/users",)
  }
}
