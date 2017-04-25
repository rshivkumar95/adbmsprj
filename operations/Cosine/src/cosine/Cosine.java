package cosine;

import java.io.File;
import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.HashSet;
import java.util.List;
import java.util.Set;

import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.xml.parsers.DocumentBuilder;
import javax.xml.parsers.DocumentBuilderFactory;
import javax.xml.parsers.ParserConfigurationException;

import org.w3c.dom.Document;
import org.w3c.dom.NodeList;
import org.w3c.dom.Node;
import org.w3c.dom.Element;

import com.datastax.driver.core.Cluster;
import com.datastax.driver.core.ResultSet;
import com.datastax.driver.core.Row;
import com.datastax.driver.core.Session;

/**
 * Servlet implementation class Temp
 */
public class Cosine extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
    /**
     * @see HttpServlet#HttpServlet()
     */
    public Cosine() {
        super();
        // TODO Auto-generated constructor stub
    }

	/**
	 * @see HttpServlet#doGet(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doGet(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		response.getWriter().append("Served at: ").append(request.getContextPath());
		response.setHeader("Access-Control-Allow-Origin", "*");
		Cluster cluster = Cluster.builder().addContactPoint("localhost").build();
	    
	      //Creating Session object
	      Session session = cluster.connect();
	      
	    
	     //PrintWriter writer = new PrintWriter("/opt/lampp/htdocs/ndnew/operations/jobresumesimilarity.txt", "UTF-8");
	    
	      
	      session.execute("USE naukridhanda");
	      
	    //Getting the ResultSet
	      String query="select * from resumes";
	      String query1="select * from jobs";
	      ResultSet result = session.execute(query);
	      ResultSet result1 = session.execute(query1);
	    
	      try {
			calculate(result,result1,response,request);
		} catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
/*PrintWriter pw=response.getWriter();
	     while (!result1.isExhausted()) {
	    	  
	    	  Row row=result1.one();
	    	  
	    	  pw.println(row.getString("skills"));
	      
	      }*/
	      
	      response.setStatus(response.SC_MOVED_TEMPORARILY);
	      response.setHeader("Location", "http://localhost/ndnew/operations/insertSimilarity.php");
	     // response.sendRedirect("http://localhost/ndnew/operations/insertSimilarity.php");
	      
      
	      
	}

	/**
	 * @see HttpServlet#doPost(HttpServletRequest request, HttpServletResponse response)
	 */
	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		// TODO Auto-generated method stub
		doGet(request, response);
	}
	
	public void calculate(ResultSet resultSet1,ResultSet resultSet2,HttpServletResponse response,HttpServletRequest request) throws Exception
	{
response.getWriter().append("Served at: ").append(request.getContextPath());
		
		Cluster cluster = Cluster.builder().addContactPoint("localhost").build();
	    
	      //Creating Session object
	      Session session = cluster.connect();
	      
	    
	     //PrintWriter writer = new PrintWriter("/opt/lampp/htdocs/ndnew/operations/jobresumesimilarity.txt", "UTF-8");
	    
	      
	      session.execute("USE naukridhanda");
	      
		ResultSet temp=resultSet2;
		PrintWriter writer = new PrintWriter("/opt/lampp/htdocs/ndnew/operations/jobresumesimilarity.txt", "UTF-8");
		String userSkills;
		String jobSkills;
		 PrintWriter pw=response.getWriter();
		int i=0;
		while(!resultSet1.isExhausted())
		{
			Row row=resultSet1.one();
		   //if(i==0)
			  // continue;
			userSkills=row.getString("skill");
			pw.println(userSkills);
			String userID=row.getString("email");
			String query1="select * from jobs";
			 resultSet2 = session.execute(query1);
			while(!resultSet2.isExhausted())
			{
				Row row1=resultSet2.one();
				jobSkills=row1.getString("skills");
				int jobID=(int) row1.getInt("jobid");
				//System.out.println(userID+","+jobID+","+sc.similarity(userSkills, jobSkills));
				String[] interSection=commonSkills(userSkills,jobSkills);
				
				int[] vector1=vector(interSection,userSkills);
				int[] vector2=vector(interSection,jobSkills);
//				while(i<interSection.length)
//				{
//					System.out.println(interSection[i]+"\t"+vector1[i]+"\t"+vector2[i]);
//					i++;
//				}
				Double sim=coSine(vector1,vector2);
				writer.println(userID+","+jobID+","+sim);
				pw.println(userID+","+jobID+","+sim);
				//Double sim=sc.similarity(userSkills, jobSkills);
				//insertData(userID,jobID,sim);
				i++;
			}
			//resultSet2=temp;
			//System.out.println(userID);
			
			
			
		}
		//loadData();
		writer.close();
		//System.out.println(i+ "Similarity Calculated");
	}
	
	public static String[] commonSkills(String fSet,String sSet)
	{
		String str=fSet.concat(sSet);
		str=str.replaceAll(", $", "");
		String a[]=str.split("\\,");
		int i=0,j=0;
		double count=0;
		int la=a.length;
		
		int k=0;
		//String finalArray[]={};
		List<String> demo=new ArrayList<String>();
		while(i<la)
		{
			j=0;
			
			while(j<la)
			{
				//System.out.print(b[j]+"+++"+b[j].trim().toLowerCase().contains(a[i].trim().toLowerCase())+"\n");
				
				if(a[j].trim().toLowerCase().contains(a[i].trim().toLowerCase()) || a[i].trim().toLowerCase().contains(a[j].trim().toLowerCase()))
				//if(Pattern.compile(Pattern.quote(b[j]), Pattern.CASE_INSENSITIVE).matcher(a[i]).find())				
				{
					//count++;
					//System.out.print(a[i]+"  "+b[j]+"-->");
					if(a[j].length()<a[i].length())
					{
					  //System.out.print(b[j]+"\n");
						//finalArray[k]=b[j];
						//k++;
						demo.add(a[j].trim());
					}
					  
					else
					{
						//System.out.print(a[i]+"\n");
//						finalArray[k]=a[i];
//						k++;
						demo.add(a[i].trim());
					}
				}
				else
				{
					demo.add(a[i].trim());
					demo.add(a[j].trim());
					
				}
				//k++;				  
				j++;
				
			}
			i++;						
		}	
		Set<String> uniqueElements = new HashSet<String>(demo);
		String[] finalArray = new String[ uniqueElements.size() ];
		uniqueElements.toArray( finalArray );
		
				
	
		return finalArray;
	}
	
	public static int[] vector(String[] intersection,String set)
	{
		int[] vector=null;
		
		int lengtha=intersection.length;
		set=set.replaceAll(", $", "");
		String a[]=set.split("\\,");
		int lengthb=a.length;
		int i=0,j=0,count;
		List<Integer> demo=new ArrayList<Integer>();
		
		while(i<lengtha)
		{
			
			j=0;
			count=0;
			while(j<lengthb)
			{
				
				if( intersection[i].trim().toLowerCase().contains(a[j].trim().toLowerCase()))
				{
					count++;
					
				}
				j++;
				
			}
			
			demo.add(count);
			
			i++;
		}
		vector=demo.stream().mapToInt((Integer m)->m).toArray();
		
		return vector;
		
	}
	
	public static Double coSine(int[] vec1,int[] vec2)
	{
	
		   double mod1=mod(vec1);
		   double mod2=mod(vec2);
		   
		   //System.out.println(mod(vec2));
		   
		   int l=vec1.length,i=0;
		   
		   double sum=0;
		   
		   while(i<l)
		   {
			   sum=sum+(vec1[i]*vec2[i]);
			   i++;
		   }
		   
		  return (sum/(mod1*mod2));
		   
		   
		   //System.out.println(sum);
				   
	}
	
	public static double mod(int[] vec)
	{
		  double mod=0.0;		
		  int sum=0;		  
		  int l=vec.length;
		  int i=0;
		  while(i<l)
		  {
			  sum=sum+(vec[i]*vec[i]);
			  i++;
		  }
		  		  		  		  		  	
		return Math.sqrt(sum);
	}
	
	

}
