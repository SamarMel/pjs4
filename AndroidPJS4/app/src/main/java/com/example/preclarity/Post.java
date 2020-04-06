package com.example.preclarity;

public class Post {
    private String pseudo, content, date, picture;

    public Post(String p,String c, String d, String pt){
        pseudo = p;
        content=c;
        date=d;
        picture=pt;
    }

    public String getPseudo(){ return pseudo;}
    public String getContent(){ return content;}
    public String getDate(){ return date;}
    public String getPicture(){ return picture;}
}
