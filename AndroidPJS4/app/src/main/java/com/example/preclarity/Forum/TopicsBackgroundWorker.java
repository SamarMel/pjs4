package com.example.preclarity.Forum;

import android.content.Context;
import android.os.AsyncTask;
import android.util.Log;

import com.example.preclarity.Forum.Topic;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;
import java.util.List;

public class TopicsBackgroundWorker extends AsyncTask<Void, Void, List<Topic>> {
    private static final String TAG = "28910" ;
    Context context;

    public TopicsBackgroundWorker(Context ctx){
        this.context = ctx;
    }


    @Override
    protected List<Topic> doInBackground(Void... voids) {
        List<Topic> lastTopics = new ArrayList<Topic>();
        String login_url="http://pjs4.ulyssebouchet.fr/Android/AccueilForum.php";
        String result="";
        try {
            URL url = new URL(login_url);
            HttpURLConnection httpURLConnection = (HttpURLConnection)url.openConnection();
            Log.w(TAG, "CONNECTEDDDDD");
            httpURLConnection.setDoInput(true);
            InputStream inputStream = httpURLConnection.getInputStream();
            BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream,"iso-8859-1"));
            String line="";
            while((line = bufferedReader.readLine())!= null) {
                result += line;
            }
            bufferedReader.close();
            inputStream.close();
            httpURLConnection.disconnect();

        } catch (MalformedURLException e) {
            Log.w(TAG, "Malformated EXCEPTIOOOOOOOON");
        } catch (IOException e) {
            Log.w(TAG, e.toString());
        }

        try {
            String s="";
            JSONArray jArray = new JSONArray(result);
            for(int i =0; i<jArray.length();i++){
                JSONObject json = jArray.getJSONObject(i);
                int id = json.getInt("id");
                String sujet= json.getString("titre");
                String auteur = json.getString("pseudo");
                String dateTopic = json.getString("datePost");
                Topic topic = new Topic(id,sujet, auteur, dateTopic, null, null);
                lastTopics.add(topic);
            }
            return lastTopics;
           // TopicAdapter adapter = new TopicAdapter(context, lastTopics);

        } catch (JSONException e) {
            e.printStackTrace();
        }


        return null;
    }
}
